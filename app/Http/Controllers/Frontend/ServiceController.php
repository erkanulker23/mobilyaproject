<?php

namespace App\Http\Controllers\Frontend;

use App\DTOs\Service\ServiceCategoryData;
use App\DTOs\Service\ServicePostData;
use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServicePost;
use App\Settings\GeneralSettings;
use App\Settings\ImageSettings;
use App\Settings\SeoSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\SchemaOrg\Schema;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $servicesQuery = ServicePost::query()
            ->latest('publish_at')
            ->ordered()
            ->published();

        // Arama özelliği
        if ($request->has('query')) {
            $servicesQuery->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->get('query') . '%')
                      ->orWhere('short_description', 'like', '%' . $request->get('query') . '%')
                      ->orWhere('description', 'like', '%' . $request->get('query') . '%');
            });
        }

        $paginatedServices = $servicesQuery->paginate(40);
        $services = ServicePostData::collection($paginatedServices);

        $seoSettings = app(SeoSettings::class);
        $imageSettings = app(ImageSettings::class);

        // SEO için dinamik title ve description
        $title = $seoSettings->services_title;
        $description = $seoSettings->services_description;

        if ($request->has('query')) {
            $searchQuery = $request->get('query');
            $title = "'{$searchQuery}' için hizmetler - " . $title;
            $description = "'{$searchQuery}' arama sonuçları. " . $description;
        }

        seo()
            ->title($title)
            ->description($description)
            ->url($request->fullUrl());

        // Get hero banner images with fallback to default images
        $heroImage = $imageSettings->service_listing_hero
            ? url(Storage::url($imageSettings->service_listing_hero))
            : url(Storage::url('default_images/service_listing_hero.webp'));
        $heroImageMobile = $imageSettings->service_listing_hero_mobile
            ? url(Storage::url($imageSettings->service_listing_hero_mobile))
            : url(Storage::url('default_images/service_listing_hero_mobile.webp'));

        return view('frontend.pages.service.index', [
            'services' => $services,
            'paginatedServices' => $paginatedServices,
            'heroImage' => $heroImage,
            'heroImageMobile' => $heroImageMobile,
        ]);
    }

    public function showServicesCategory(Request $request, ServiceCategory $serviceCategory)
    {
        $category = ServiceCategoryData::from($serviceCategory);
        $postQuery = ServicePost::query()
            ->latest('publish_at')
            ->whereHas('categories', function ($query) use ($serviceCategory) {
                $query->where('service_categories.id', $serviceCategory->id);
            })
            ->ordered()
            ->published();

        $paginatedPosts = $postQuery->get();

        $posts = ServicePostData::collection($paginatedPosts);

        seo()
            ->title($category->seoTitle ?: $category->name)
            ->description($category->seoDescription ?: $category->name)
            ->url($request->fullUrl());

        return view('frontend.pages.service-category.index', [
            'posts' => $posts,
            'category' => $category,
        ]);
    }

    public function showPost(Request $request, ServicePost $servicePost, GeneralSettings $generalSettings)
    {
        visitor()->visit($servicePost);

        $data = ServicePostData::fromModel($servicePost);
        $categoryId = $data->categories->pluck('id')->first();
        $relevantServicesModels = ServicePost::where('id', '!=', $servicePost->id)
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('service_categories.id', $categoryId);
            })
            ->latest()
            ->get();
        $relevantServices = ServicePostData::collection($relevantServicesModels);

        $otherServiceCategoriesModel = ServiceCategory::where('id', '!=', $categoryId)
            ->where('is_active', true)
            ->get();

        $otherServiceCategories = ServiceCategoryData::collection($otherServiceCategoriesModel);

        seo()
            ->title($servicePost->seo_title ?: $servicePost->title)
            ->description($servicePost->seo_description ?: $servicePost->title)
            ->image($data->listingImage ?: '/')
            ->locale(app()->getLocale())
            ->site($generalSettings->site_name)
            ->url($request->fullUrl())
            ->tag('author', $generalSettings->site_name)

            ->twitterImage($servicePost->listingImage ?? '/')
            ->twitterSite($generalSettings->site_name)
            ->twitterTitle($servicePost->seo_title ?? $servicePost->title)
            ->twitterDescription($servicePost->seo_description ?? '');

        $servicePostingScript = Schema::blogPosting()
            ->headline($servicePost->title)
            ->alternativeHeadline($servicePost->seoDescription)
            ->image($servicePost->listingImage)
            ->author(Schema::person()->name($generalSettings->site_name))
            ->datePublished($servicePost->publishAt)
            ->dateModified($servicePost->updatedAt)
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
            ->articleBody(Str::words($servicePost->shortDescription, 48, '...'));


        return view('frontend.pages.service.show', [
            'servicePost' => $data,
            'relevantServices' => $relevantServices,
            'otherServiceCategories' => $otherServiceCategories,
            'servicePostingScript' => $servicePostingScript,
        ]);
    }
}
