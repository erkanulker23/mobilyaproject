<?php

namespace Modules\GoogleReview\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GooglePlacesService
{
    protected $apiKey;
    protected $baseUrl = 'https://maps.googleapis.com/maps/api';
    protected $newBaseUrl = 'https://places.googleapis.com/v1';

    public function __construct()
    {
        try {
            $settings = app(\App\Settings\GeneralSettings::class);
            $this->apiKey = $settings->google_places_api_key ?? '';
        } catch (\Exception $e) {
            $this->apiKey = '';
        }
    }

    /**
     * Set API key manually
     *
     * @param string $apiKey
     * @return void
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Get current API key
     *
     * @return string|null
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * Extract Place ID from Google Maps URL (NEW API)
     *
     * @param string $url
     * @return string|null
     */
    public function extractPlaceIdFromUrl(string $url): ?string
    {
        // Method 1: Extract business name and search by text
        $businessName = $this->extractBusinessNameFromUrl($url);
        if ($businessName) {
            Log::info('Searching by business name', ['name' => $businessName]);
            $results = $this->searchPlace($businessName);
            if (!empty($results)) {
                Log::info('Found place by name', ['place_id' => $results[0]['place_id']]);
                return $results[0]['place_id'] ?? null;
            }
        }

        // Method 2: Extract coordinates and search nearby
        if (preg_match('/@(-?[\d.]+),(-?[\d.]+)/', $url, $matches)) {
            $lat = $matches[1];
            $lng = $matches[2];
            Log::info('Searching by coordinates', ['lat' => $lat, 'lng' => $lng]);

            $placeId = $this->getPlaceIdFromCoordinates($lat, $lng);
            if ($placeId) {
                Log::info('Found place by coordinates', ['place_id' => $placeId]);
                return $placeId;
            }
        }

        // Method 3: Try to extract CID and convert
        if (preg_match('/!1s(0x[a-f0-9]+:0x[a-f0-9]+)/i', $url, $matches)) {
            Log::info('Searching by CID', ['cid' => $matches[1]]);
            $placeId = $this->getPlaceIdFromCid($matches[1]);
            if ($placeId) {
                Log::info('Found place by CID', ['place_id' => $placeId]);
                return $placeId;
            }
        }

        Log::warning('Could not extract Place ID from URL', ['url' => $url]);
        return null;
    }

    /**
     * Get Place ID from CID (0x... format) - NEW API
     *
     * @param string $cid
     * @return string|null
     */
    protected function getPlaceIdFromCid(string $cid): ?string
    {
        if (empty($this->apiKey)) {
            return null;
        }

        try {
            // Use NEW API to search by CID
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Goog-Api-Key' => $this->apiKey,
                'X-Goog-FieldMask' => 'places.id,places.displayName,places.formattedAddress',
            ])->post("{$this->newBaseUrl}/places:searchText", [
                'textQuery' => $cid,
                'languageCode' => 'tr',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['places'][0]['id'])) {
                    $placeId = $data['places'][0]['id'];
                    return str_replace('places/', '', $placeId);
                }
            }

            return null;
        } catch (\Exception $e) {
            Log::error('CID Search Error', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Get Place ID from coordinates (NEW API)
     *
     * @param float $lat
     * @param float $lng
     * @return string|null
     */
    public function getPlaceIdFromCoordinates($lat, $lng): ?string
    {
        if (empty($this->apiKey)) {
            return null;
        }

        try {
            // Use NEW Places API - Nearby Search
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Goog-Api-Key' => $this->apiKey,
                'X-Goog-FieldMask' => 'places.id,places.displayName,places.formattedAddress',
            ])->post("{$this->newBaseUrl}/places:searchNearby", [
                'locationRestriction' => [
                    'circle' => [
                        'center' => [
                            'latitude' => floatval($lat),
                            'longitude' => floatval($lng),
                        ],
                        'radius' => 50.0, // 50 meter radius
                    ],
                ],
                'maxResultCount' => 1,
                'languageCode' => 'tr',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['places'][0]['id'])) {
                    // New API returns place ID in format: places/ChIJ...
                    $placeId = $data['places'][0]['id'];
                    // Remove 'places/' prefix if present
                    return str_replace('places/', '', $placeId);
                }
            }

            Log::error('Nearby Search Error', ['response' => $response->json()]);
        } catch (\Exception $e) {
            Log::error('Nearby Search Error', ['error' => $e->getMessage()]);
        }

        return null;
    }

    /**
     * Extract business name from Google Maps URL
     *
     * @param string $url
     * @return string|null
     */
    public function extractBusinessNameFromUrl(string $url): ?string
    {
        // Pattern: /maps/place/Business+Name/@
        if (preg_match('/\/maps\/place\/([^\/]+)\/@/', $url, $matches)) {
            return urldecode(str_replace('+', ' ', $matches[1]));
        }

        return null;
    }

    /**
     * Search for a place by name (NEW API)
     *
     * @param string $query
     * @return array|null
     */
    public function searchPlace(string $query): ?array
    {
        if (empty($this->apiKey)) {
            throw new \Exception('Google API key is not configured. Please set GOOGLE_PLACES_API_KEY in your .env file.');
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Goog-Api-Key' => $this->apiKey,
                'X-Goog-FieldMask' => 'places.id,places.displayName,places.formattedAddress,places.rating,places.userRatingCount',
            ])->post("{$this->newBaseUrl}/places:searchText", [
                'textQuery' => $query,
                'languageCode' => 'tr',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['places']) && !empty($data['places'])) {
                    // Convert new format to old format
                    $candidates = [];
                    foreach ($data['places'] as $place) {
                        $placeId = $place['id'];
                        // Remove 'places/' prefix if present
                        $placeId = str_replace('places/', '', $placeId);

                        $candidates[] = [
                            'place_id' => $placeId,
                            'name' => $place['displayName']['text'] ?? '',
                            'formatted_address' => $place['formattedAddress'] ?? '',
                            'rating' => $place['rating'] ?? 0,
                            'user_ratings_total' => $place['userRatingCount'] ?? 0,
                        ];
                    }
                    return $candidates;
                }

                return [];
            }

            $error = $response->json();
            Log::error('Google Places API Error', ['response' => $error]);
            throw new \Exception('Google Places API returned an error: ' . ($error['error']['message'] ?? 'Unknown'));
        } catch (\Exception $e) {
            Log::error('Google Places Search Error', [
                'query' => $query,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Get place details including reviews (New API)
     *
     * @param string $placeId
     * @return array|null
     */
    public function getPlaceDetails(string $placeId): ?array
    {
        if (empty($this->apiKey)) {
            throw new \Exception('Google API key is not configured.');
        }

        // Cache for 1 hour
        $cacheKey = "google_place_details_{$placeId}";

        return Cache::remember($cacheKey, 3600, function () use ($placeId) {
            try {
                // Use NEW Places API (v1) - Add 'places/' prefix if not present
                $formattedPlaceId = $placeId;
                if (!str_starts_with($placeId, 'places/')) {
                    $formattedPlaceId = 'places/' . $placeId;
                }

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'X-Goog-Api-Key' => $this->apiKey,
                    'X-Goog-FieldMask' => 'id,displayName,formattedAddress,rating,userRatingCount,reviews,internationalPhoneNumber,websiteUri',
                    'X-Goog-LanguageCode' => 'tr',
                ])->get("{$this->newBaseUrl}/{$formattedPlaceId}");

                if ($response->successful()) {
                    $data = $response->json();

                    // Convert new API format to old format for compatibility
                    return $this->convertNewApiToOldFormat($data);
                }

                $error = $response->json();
                Log::error('Google Place Details Error (New API)', ['response' => $error]);
                throw new \Exception('Failed to get place details: ' . ($error['error']['message'] ?? 'Unknown'));
            } catch (\Exception $e) {
                Log::error('Google Place Details Error', [
                    'place_id' => $placeId,
                    'error' => $e->getMessage()
                ]);
                throw $e;
            }
        });
    }

    /**
     * Convert new API format to old format
     */
    protected function convertNewApiToOldFormat(array $newData): array
    {
        return [
            'name' => $newData['displayName']['text'] ?? '',
            'formatted_address' => $newData['formattedAddress'] ?? '',
            'rating' => $newData['rating'] ?? 0,
            'user_ratings_total' => $newData['userRatingCount'] ?? 0,
            'formatted_phone_number' => $newData['internationalPhoneNumber'] ?? null,
            'website' => $newData['websiteUri'] ?? null,
            'place_id' => $newData['id'] ?? '',
            'reviews' => $this->convertNewApiReviews($newData['reviews'] ?? []),
        ];
    }

    /**
     * Convert new API reviews to old format
     */
    protected function convertNewApiReviews(array $newReviews): array
    {
        $converted = [];
        foreach ($newReviews as $review) {
            $converted[] = [
                'author_name' => $review['authorAttribution']['displayName'] ?? 'Anonymous',
                'profile_photo_url' => $review['authorAttribution']['photoUri'] ?? null,
                'rating' => $review['rating'] ?? 5,
                'text' => $review['text']['text'] ?? '',
                'time' => isset($review['publishTime']) ? strtotime($review['publishTime']) : time(),
                'language' => $review['originalText']['languageCode'] ?? 'tr',
                'author_url' => $review['authorAttribution']['uri'] ?? null,
            ];
        }
        return $converted;
    }

    /**
     * Get reviews for a place
     *
     * @param string $placeId
     * @return array
     */
    public function getPlaceReviews(string $placeId): array
    {
        $details = $this->getPlaceDetails($placeId);

        if (!isset($details['reviews'])) {
            return [];
        }

        return $details['reviews'];
    }

    /**
     * Format Google review data for our system
     *
     * @param array $googleReview
     * @param string $placeId
     * @return array
     */
    public function formatReviewData(array $googleReview, string $placeId): array
    {
        return [
            'reviewer_name' => $googleReview['author_name'] ?? 'Anonymous',
            'reviewer_email' => null, // Google doesn't provide email
            'reviewer_avatar_url' => $googleReview['profile_photo_url'] ?? null,
            'rating' => $googleReview['rating'] ?? 5,
            'review_text' => $googleReview['text'] ?? '',
            'review_date' => isset($googleReview['time'])
                ? \Carbon\Carbon::createFromTimestamp($googleReview['time'])
                : now(),
            'is_published' => true,
            'is_featured' => ($googleReview['rating'] ?? 0) >= 5,
            'is_anonymous' => false,
            'google_review_id' => $googleReview['author_url'] ?? null,
            'place_id' => $placeId,
            'language' => $googleReview['language'] ?? 'tr',
            'order' => 0,
        ];
    }

    /**
     * Get photo URL from Google
     *
     * @param string $photoReference
     * @param int $maxWidth
     * @return string
     */
    public function getPhotoUrl(string $photoReference, int $maxWidth = 400): string
    {
        return "{$this->baseUrl}/place/photo?maxwidth={$maxWidth}&photo_reference={$photoReference}&key={$this->apiKey}";
    }

    /**
     * Verify API key is valid
     *
     * @return bool
     */
    public function verifyApiKey(): bool
    {
        if (empty($this->apiKey)) {
            return false;
        }

        try {
            $response = Http::get("{$this->baseUrl}/place/findplacefromtext/json", [
                'input' => 'test',
                'inputtype' => 'textquery',
                'fields' => 'place_id',
                'key' => $this->apiKey,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                // If status is not REQUEST_DENIED, API key is valid
                return !isset($data['status']) || $data['status'] !== 'REQUEST_DENIED';
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Google API Key Verification Failed', ['error' => $e->getMessage()]);
            return false;
        }
    }
}

