<?php

namespace App\DTOs\Service;

use App\Models\ServiceCategory;

class ServiceCategoryData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $slug,
        public ?string $shortDescription,
        public ?string $content,
        public ?string $seoTitle,
        public ?string $seoDescription,
        public int $orderColumn,
        public bool $isActive,
        public string $url,
        public $detailsImage,
        public $detailsHero,
        public $iconImage,
    ) {
        //
    }

    public static function fromModel(ServiceCategory $serviceCategory): self
    {
        return new self(
            id: $serviceCategory->id,
            name: $serviceCategory->name,
            slug: $serviceCategory->slug,
            shortDescription: $serviceCategory->short_description,
            content: $serviceCategory->content,
            seoTitle: $serviceCategory->seo_title,
            seoDescription: $serviceCategory->seo_description,
            orderColumn: $serviceCategory->order_column,
            isActive: $serviceCategory->is_active,
            url: $serviceCategory->url,
            detailsImage: $serviceCategory->getFirstMediaUrl('category_details_image'),
            detailsHero: $serviceCategory->getFirstMediaUrl('category_details_hero'),
            iconImage: $serviceCategory->getFirstMediaUrl('category_icon'),
        );
    }
}
