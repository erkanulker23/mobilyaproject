<?php

namespace App\DTOs\Blog;

use App\DTOs\Gallery\GalleryCategoryData;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Enumerable;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class BlogPostData extends \Spatie\LaravelData\Data
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
        public $category,
        public $listingImage,
        public $listingImageMobile,
        public $detailImage,
        public $detailImageMobile,
        public $detailHero,
        public $detailHeroMobile,
        public string $url,
        public ?GalleryCategoryData $gallery,
        public int $viewCount,
        public $comments = null,
    ) {
        //
    }

    public static function fromModel(BlogPost $blogPost): self
    {
        $category = $blogPost->categories->first();
        $categories = $blogPost->categories;
        $gallery = $blogPost->galleryCategory ? GalleryCategoryData::from($blogPost->galleryCategory) : null;

        // Load comments if relation exists
        $comments = $blogPost->relationLoaded('comments') ? $blogPost->comments : null;

        // Get gallery first image if available
        $galleryFirstImage = $gallery && $gallery->entries && count($gallery->entries) > 0
            ? $gallery->entries[0]->image
            : null;

        // Get images with fallback to gallery
        $detailsImage = $blogPost->getFirstMediaUrl('details_image');
        $detailsImageMobile = $blogPost->getFirstMediaUrl('details_image_mobile') ?: $galleryFirstImage;
        $detailHero = $blogPost->getFirstMediaUrl('details_hero');
        $detailHeroMobile = $blogPost->getFirstMediaUrl('details_hero_mobile') ?: $galleryFirstImage;
        $listingImage = $blogPost->getFirstMediaUrl('listing_image');
        $listingImageMobile = $blogPost->getFirstMediaUrl('listing_image_mobile') ?: $galleryFirstImage;

        return new self(
            id: $blogPost->id,
            title: $blogPost->title,
            slug: $blogPost->slug,
            shortDescription: $blogPost->short_description,
            content: $blogPost->content,
            seoTitle: $blogPost->seo_title,
            seoDescription: $blogPost->seo_description,
            icon: $blogPost->icon,
            customIcon: $blogPost->custom_icon,
            publishAt: $blogPost->publish_at,
            updatedAt: $blogPost->updated_at,
            media: $blogPost->media,
            categories: $categories,
            category: $category,
            listingImage: $listingImage,
            listingImageMobile: $listingImageMobile,
            detailImage: $detailsImage,
            detailImageMobile: $detailsImageMobile,
            detailHero: $detailHero,
            detailHeroMobile: $detailHeroMobile,
            url: $blogPost->url,
            gallery: $gallery,
            viewCount: $blogPost->visitLogs()->distinct('ip')->count('ip'),
            comments: $comments,
        );
    }

    public static function collection(Paginator|Enumerable|array|AbstractCursorPaginator|DataCollection|AbstractPaginator|CursorPaginator|null $items): DataCollection|CursorPaginatedDataCollection|PaginatedDataCollection
    {
        $items->load('media', 'categories', 'galleryCategory');

        return parent::collection($items);
    }
}
