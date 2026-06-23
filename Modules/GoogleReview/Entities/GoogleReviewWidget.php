<?php

namespace Modules\GoogleReview\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoogleReviewWidget extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'layout_type',
        'style_variant',
        'is_active',
        'settings',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
        'order' => 'integer',
    ];

    /**
     * Default settings
     */
    protected $attributes = [
        'settings' => '{}',
    ];

    /**
     * Available layout types
     */
    public const LAYOUT_GRID = 'grid';
    public const LAYOUT_LIST = 'list';
    public const LAYOUT_SLIDER = 'slider';
    public const LAYOUT_MASONRY = 'masonry';

    /**
     * Get all available layouts
     */
    public static function getAvailableLayouts(): array
    {
        return [
            self::LAYOUT_GRID => 'Grid Layout',
            self::LAYOUT_LIST => 'List Layout',
            self::LAYOUT_SLIDER => 'Slider Layout',
            self::LAYOUT_MASONRY => 'Masonry Layout',
        ];
    }

    /**
     * Get widget settings with defaults
     */
    public function getSettings(): array
    {
        $defaults = [
            'reviews_per_page' => 10,
            'show_rating' => true,
            'show_date' => true,
            'show_avatar' => true,
            'show_reviewer_name' => true,
            'min_rating' => 1,
            'columns' => 3,
            'autoplay' => true,
            'autoplay_speed' => 3000,
            'show_navigation' => true,
            'show_pagination' => true,
            'filter_by_featured' => false,
            'filter_by_rating' => null,
        ];

        return array_merge($defaults, $this->settings ?? []);
    }

    /**
     * Get reviews based on widget settings
     */
    public function getReviews()
    {
        $query = GoogleReview::published()->ordered();

        $settings = $this->getSettings();

        if ($settings['filter_by_featured']) {
            $query->featured();
        }

        if ($settings['filter_by_rating']) {
            $query->minRating($settings['filter_by_rating']);
        }

        if ($settings['min_rating'] > 1) {
            $query->minRating($settings['min_rating']);
        }

        return $query->limit($settings['reviews_per_page'])->get();
    }

    /**
     * Scope a query to only include active widgets.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by custom order field.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('name', 'asc');
    }

    /**
     * Generate slug from name
     */
    public function generateSlug(): string
    {
        return \Illuminate\Support\Str::slug($this->name);
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($widget) {
            if (empty($widget->slug)) {
                $widget->slug = $widget->generateSlug();
            }
        });
    }

}


