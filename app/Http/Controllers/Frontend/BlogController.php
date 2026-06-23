<?php

namespace App\Http\Controllers\Frontend;

use App\DTOs\Blog\BlogPostData;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Settings\GeneralSettings;
use App\Settings\ImageSettings;
use App\Settings\SeoSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\SchemaOrg\Schema;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $postQuery = BlogPost::query()
            ->latest('publish_at')
            ->published();

        $categoriesQuery = BlogCategory::query()
            ->withCount('posts')
            ->orderBy('posts_count', 'desc');

        if ($request->has('category')) {
            $postQuery->whereHas('categories', function ($query) use ($request) {
                $query->where('slug', $request->get('category'));
            });
        }

        if ($request->has('query')) {
            $postQuery->where('title', 'like', '%'.$request->get('query').'%');
        }

        $paginatedPosts = $postQuery->get();
        $categories = $categoriesQuery->get();

        $posts = BlogPostData::collection($paginatedPosts);
        $latestPosts = BlogPostData::collection(
            BlogPost::query()
                ->latest('publish_at')
                ->published()
                ->limit(15)
                ->get()
        );

        $seoSettings = app(SeoSettings::class);
        $imageSettings = app(ImageSettings::class);

        if ($request->has('category')) {
            $category = $categories->firstWhere('slug', $request->get('category'));
            seo()
                ->title($category->seo_title ?? $category->name)
                ->description($category->seo_description ?? '')
                ->url($request->fullUrl());
        } else {
            seo()
                ->title($seoSettings->blog_title)
                ->description($seoSettings->blog_description)
                ->url($request->fullUrl());
        }

        // Get hero banner images with fallback to default images
        $heroImage = $imageSettings->blog_category_hero
            ? url(Storage::url($imageSettings->blog_category_hero))
            : url(Storage::url('default_images/blog_category_hero.webp'));
        $heroImageMobile = $imageSettings->blog_category_hero_mobile
            ? url(Storage::url($imageSettings->blog_category_hero_mobile))
            : url(Storage::url('default_images/blog_category_hero_mobile.webp'));

        return view('frontend.pages.blog.index', [
            'posts' => $posts,
            'paginatedPosts' => $paginatedPosts,
            'categories' => $categories,
            'latestPosts' => $latestPosts,
            'heroImage' => $heroImage,
            'heroImageMobile' => $heroImageMobile,
        ]);
    }

    public function showPost(Request $request, BlogPost $post, GeneralSettings $generalSettings)
    {
        abort_if(! $post->isPublished(), 404);

        visitor()->visit($post);

        // Load comments with children and count
        $post->load(['comments' => function($query) {
            $query->where('is_approved', true)
                  ->whereNull('parent_id')
                  ->with(['children' => function($childQuery) {
                      $childQuery->where('is_approved', true)->orderBy('created_at', 'asc');
                  }])
                  ->orderBy('created_at', 'desc');
        }]);

        // Add comments count
        $post->comments_count = $post->comments->count();

        $latestPosts = BlogPostData::collection(
            BlogPost::query()
                ->with('galleryCategory.galleryEntries', 'media')
                ->latest('publish_at')
                ->published()
                ->where('id', '!=', $post->id)
                ->limit(15)
                ->get()
        );

        $categories = BlogCategory::query()
            ->withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->get();


        $blogPostData = BlogPostData::from($post);

        seo()
            ->title($post->seo_title ?? $post->title)
            ->description($post->seo_description ?? '')
            ->image($blogPostData->listingImage ?? '/')
            ->locale(app()->getLocale())
            ->site($generalSettings->site_name)
            ->url($request->fullUrl())
            ->tag('author', $generalSettings->site_name)

            ->twitterImage($blogPostData->listingImage ?? '/')
            ->twitterSite($generalSettings->site_name)
            ->twitterTitle($post->seo_title ?? $post->title)
            ->twitterDescription($post->seo_description ?? '');


        $blogPostingScript = Schema::blogPosting()
            ->headline($blogPostData->title)
            ->alternativeHeadline($blogPostData->seoDescription)
            ->image($blogPostData->listingImage)
            ->author(Schema::person()->name($generalSettings->site_name))
            ->datePublished($blogPostData->publishAt)
            ->dateModified($blogPostData->updatedAt)
            ->mainEntityOfPage($request->fullUrl())
            ->publisher(
                Schema::organization()
                    ->name($generalSettings->site_name)
                    ->logo(
                        Schema::imageObject()
                            ->url(url(Storage::url($generalSettings->header_logo)))
                    )
            )
            ->author(Schema::person()->name($generalSettings->site_name))
            ->articleBody(Str::words($blogPostData->shortDescription, 48, '...'));



        return view('frontend.pages.blog.show', [
            'post' => $blogPostData,
            'latestPosts' => $latestPosts,
            'categories' => $categories,
            'blogPostingScript' => $blogPostingScript,
        ]);
    }

    public function trackShare(Request $request, BlogPost $post)
    {
        $request->validate([
            'platform' => 'required|string|in:facebook,twitter,linkedin,email',
        ]);

        try {
            // Paylaşım sayısını artır
            $currentShares = $post->share_count ?? 0;
            $post->update(['share_count' => $currentShares + 1]);

            return response()->json([
                'success' => true,
                'message' => 'Paylaşım kaydedildi',
                'share_count' => $currentShares + 1
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Paylaşım kaydedilemedi'
            ], 500);
        }
    }
}
