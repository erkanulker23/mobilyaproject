<?php

namespace Modules\GoogleReview\DTOs;

use Carbon\Carbon;

class GoogleReviewData
{
    public function __construct(
        public string $reviewer_name,
        public int $rating,
        public string $review_text,
        public ?string $reviewer_email = null,
        public ?string $reviewer_avatar_url = null,
        public ?Carbon $review_date = null,
        public bool $is_published = true,
        public bool $is_featured = false,
        public bool $is_anonymous = false,
        public ?string $google_review_id = null,
        public ?string $place_id = null,
        public string $language = 'tr',
        public int $order = 0,
    ) {
    }

    /**
     * Create from array
     */
    public static function fromArray(array $data): self
    {
        return new self(
            reviewer_name: $data['reviewer_name'],
            rating: $data['rating'],
            review_text: $data['review_text'],
            reviewer_email: $data['reviewer_email'] ?? null,
            reviewer_avatar_url: $data['reviewer_avatar_url'] ?? null,
            review_date: isset($data['review_date']) ? Carbon::parse($data['review_date']) : null,
            is_published: $data['is_published'] ?? true,
            is_featured: $data['is_featured'] ?? false,
            is_anonymous: $data['is_anonymous'] ?? false,
            google_review_id: $data['google_review_id'] ?? null,
            place_id: $data['place_id'] ?? null,
            language: $data['language'] ?? 'tr',
            order: $data['order'] ?? 0,
        );
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return [
            'reviewer_name' => $this->reviewer_name,
            'reviewer_email' => $this->reviewer_email,
            'reviewer_avatar_url' => $this->reviewer_avatar_url,
            'rating' => $this->rating,
            'review_text' => $this->review_text,
            'review_date' => $this->review_date?->toDateTimeString(),
            'is_published' => $this->is_published,
            'is_featured' => $this->is_featured,
            'is_anonymous' => $this->is_anonymous,
            'google_review_id' => $this->google_review_id,
            'place_id' => $this->place_id,
            'language' => $this->language,
            'order' => $this->order,
        ];
    }

    /**
     * Validate rating
     */
    public function validateRating(): bool
    {
        return $this->rating >= 1 && $this->rating <= 5;
    }
}

