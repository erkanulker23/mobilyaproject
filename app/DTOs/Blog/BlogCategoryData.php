<?php

namespace App\DTOs\Blog;

use App\Models\BlogCategory;

class BlogCategoryData extends \Spatie\LaravelData\Data
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
    ) {
        //
    }

    public static function fromModel(BlogCategory $blogCategory): self
    {
        return new self(
            id: $blogCategory->id,
            name: $blogCategory->name,
            slug: $blogCategory->slug,
            shortDescription: $blogCategory->short_description,
            content: $blogCategory->content,
            seoTitle: $blogCategory->seo_title,
            seoDescription: $blogCategory->seo_description,
            orderColumn: $blogCategory->order_column,
            isActive: $blogCategory->is_active,
            url: $blogCategory->url,
        );
    }
}
