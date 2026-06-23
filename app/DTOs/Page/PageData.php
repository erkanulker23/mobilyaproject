<?php

namespace App\DTOs\Page;

use App\Models\Page;

class PageData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $shortDescription,
        public ?string $content,
        public ?string $seoTitle,
        public ?string $seoDescription,
        public ?string $detailsImage,
        public ?string $detailsImageMobile,
        public ?string $detailsHero,
        public ?string $detailsHeroMobile,
        public string $url,
    ) {
        //
    }

    public static function fromModel(Page $page): self
    {
        return new self(
            id: $page->id,
            title: $page->title,
            shortDescription: $page->short_description,
            content: $page->content,
            seoTitle: $page->seo_title,
            seoDescription: $page->seo_description,
            detailsImage: $page->getFirstMediaUrl('details_image'),
            detailsImageMobile: $page->getFirstMediaUrl('details_image_mobile'),
            detailsHero: $page->getFirstMediaUrl('details_hero'),
            detailsHeroMobile: $page->getFirstMediaUrl('details_hero_mobile'),
            url: $page->url,
        );
    }
}
