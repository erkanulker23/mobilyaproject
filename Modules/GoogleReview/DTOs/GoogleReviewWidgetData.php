<?php

namespace Modules\GoogleReview\DTOs;

class GoogleReviewWidgetData
{
    public function __construct(
        public string $name,
        public string $layout_type,
        public ?string $slug = null,
        public string $style_variant = 'variant_1',
        public bool $is_active = true,
        public array $settings = [],
        public int $order = 0,
    ) {
        $this->slug = $slug ?? $this->generateSlug();
    }

    /**
     * Create from array
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            layout_type: $data['layout_type'],
            slug: $data['slug'] ?? null,
            style_variant: $data['style_variant'] ?? 'variant_1',
            is_active: $data['is_active'] ?? true,
            settings: $data['settings'] ?? [],
            order: $data['order'] ?? 0,
        );
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'layout_type' => $this->layout_type,
            'style_variant' => $this->style_variant,
            'is_active' => $this->is_active,
            'settings' => $this->settings,
            'order' => $this->order,
        ];
    }

    /**
     * Generate slug from name
     */
    private function generateSlug(): string
    {
        return \Illuminate\Support\Str::slug($this->name);
    }

    /**
     * Validate layout type
     */
    public function validateLayoutType(): bool
    {
        return in_array($this->layout_type, ['grid', 'list', 'slider', 'masonry']);
    }

    /**
     * Get default settings merged with current settings
     */
    public function getSettingsWithDefaults(): array
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

        return array_merge($defaults, $this->settings);
    }
}

