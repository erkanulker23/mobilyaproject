<?php

namespace Modules\GoogleReview\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GoogleBusiness extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'google_maps_url',
        'place_id',
        'formatted_address',
        'rating',
        'user_ratings_total',
        'phone',
        'website',
        'is_active',
        'last_sync_at',
        'api_data',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'float',
        'user_ratings_total' => 'integer',
        'last_sync_at' => 'datetime',
        'api_data' => 'array',
    ];

    /**
     * Get all reviews for this business
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(GoogleReview::class, 'google_business_id');
    }

    /**
     * Get published reviews
     */
    public function publishedReviews()
    {
        return $this->reviews()->published();
    }

    /**
     * Scope to only active businesses
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Extract business name from Google Maps URL
     */
    public static function extractNameFromUrl(string $url): ?string
    {
        if (preg_match('/\/maps\/place\/([^\/]+)\/@/', $url, $matches)) {
            return urldecode(str_replace('+', ' ', $matches[1]));
        }
        return null;
    }

    /**
     * Extract coordinates from Google Maps URL
     */
    public static function extractCoordinatesFromUrl(string $url): ?array
    {
        if (preg_match('/@(-?[\d.]+),(-?[\d.]+)/', $url, $matches)) {
            return [
                'lat' => floatval($matches[1]),
                'lng' => floatval($matches[2]),
            ];
        }
        return null;
    }
}

