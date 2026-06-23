<?php

namespace App\DTOs\Slider;

use Spatie\LaravelData\Data;

class SlideData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $subtitle,
        public ?string $content,
        public ?string $titleColor,
        public ?string $subtitleColor,
        public ?string $contentColor,
        public bool $showTitleOnMobile,
        public bool $showSubtitleOnMobile,
        public bool $showContentOnMobile,
        public ?string $ctaText,
        public ?string $linkUrl,
        public ?string $imageUrl,
        public ?string $mobileImageUrl,
    ) {
        //
    }

    public static function fromModel($slide): self
    {
        return new self(
            id: $slide->id,
            title: $slide->title,
            subtitle: $slide->subtitle,
            content: $slide->content,
            titleColor: $slide->title_color,
            subtitleColor: $slide->subtitle_color,
            contentColor: $slide->content_color,
            showTitleOnMobile: $slide->show_title_on_mobile ?? true,
            showSubtitleOnMobile: $slide->show_subtitle_on_mobile ?? true,
            showContentOnMobile: $slide->show_content_on_mobile ?? true,
            ctaText: $slide->cta_text,
            linkUrl: $slide->link_url,
            imageUrl: $slide->getFirstMediaUrl('image'),
            mobileImageUrl: $slide->getFirstMediaUrl('mobile_image'),
        );
    }
}
