<?php

namespace Modules\GoogleReview\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class GoogleReview extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'google_business_id',
        'reviewer_name',
        'reviewer_email',
        'reviewer_avatar_url',
        'rating',
        'review_text',
        'review_date',
        'is_published',
        'is_featured',
        'is_anonymous',
        'google_review_id',
        'place_id',
        'language',
        'order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'is_anonymous' => 'boolean',
        'review_date' => 'datetime',
        'order' => 'integer',
    ];

    protected $appends = ['display_name'];

    /**
     * Get the business this review belongs to
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(GoogleBusiness::class, 'google_business_id');
    }

    /**
     * Get the reviewer's display name
     */
    public function getDisplayNameAttribute(): string
    {
        if ($this->is_anonymous) {
            return substr($this->reviewer_name, 0, 1) . str_repeat('*', strlen($this->reviewer_name) - 1);
        }

        return $this->reviewer_name;
    }

    /**
     * Scope a query to only include published reviews.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only include featured reviews.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter by minimum rating.
     */
    public function scopeMinRating($query, $rating)
    {
        return $query->where('rating', '>=', $rating);
    }

    /**
     * Scope a query to order by custom order field.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('review_date', 'desc');
    }

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->useFallbackUrl('/defaults/avatar.png');
    }

    /**
     * Get the avatar URL
     */
    public function getAvatarUrl(): string
    {
        if ($this->hasMedia('avatar')) {
            return $this->getFirstMediaUrl('avatar');
        }

        if ($this->reviewer_avatar_url) {
            return $this->reviewer_avatar_url;
        }

        return '/defaults/avatar.png';
    }

    /**
     * Get star rating HTML
     */
    public function getStarsHtml(): string
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<i class="fas fa-star"></i>';
            } else {
                $stars .= '<i class="far fa-star"></i>';
            }
        }
        return $stars;
    }

}


