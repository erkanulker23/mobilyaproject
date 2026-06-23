<?php

namespace App\DTOs\Service;

use App\Models\ServicePost;
use Carbon\Carbon;

class ServicePostData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $slug,
        public ?string $shortDescription,
        public ?string $content,
        public ?string $seoTitle,
        public ?string $seoDescription,
        public ?string $icon,
        public ?string $customIcon,
        public Carbon $publishAt,
        public Carbon $updatedAt,
        public $media,
        public $categories,
        public $listingImage,
        public $listingImageMobile,
        public $detailImage,
        public $detailImageMobile,
        public $detailHero,
        public $detailHeroMobile,
        public string $url,
        public int $viewCount,
        public ?string $jotformId,
    ) {
        //
    }

    public static function fromModel(ServicePost $servicePost): self
    {
        return new self(
            id: $servicePost->id,
            title: $servicePost->title,
            slug: $servicePost->slug,
            shortDescription: $servicePost->short_description,
            content: $servicePost->content,
            seoTitle: $servicePost->seo_title,
            seoDescription: $servicePost->seo_description,
            icon: $servicePost->icon,
            customIcon: $servicePost->custom_icon,
            publishAt: $servicePost->publish_at,
            updatedAt: $servicePost->updated_at,
            media: $servicePost->media,
            categories: $servicePost->categories,
            listingImage: $servicePost->getFirstMediaUrl('listing_image'),
            listingImageMobile: $servicePost->getFirstMediaUrl('listing_image_mobile'),
            detailImage: $servicePost->getFirstMediaUrl('details_image'),
            detailImageMobile: $servicePost->getFirstMediaUrl('details_image_mobile'),
            detailHero: $servicePost->getFirstMediaUrl('details_hero'),
            detailHeroMobile: $servicePost->getFirstMediaUrl('details_hero_mobile'),
            url: $servicePost->url,
            viewCount: $servicePost->visitLogs()->distinct('ip')->count('ip'),
            jotformId: $servicePost->jotform_id,
        );
    }
}
