<?php

namespace App\Http\Controllers\Frontend;

use App\DTOs\Gallery\GalleryCategoryData;
use App\DTOs\Testimonial\TestimonialData;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Settings\ImageSettings;
use App\Settings\SeoSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Gallery\Entities\GalleryCategory;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $galleryCategories = GalleryCategoryData::collection(
            GalleryCategory::query()
                ->with(['galleryEntries' => function ($query) {
                    $query->ordered()->with('media');
                }])
                ->ordered()
                ->where('is_listable', true)
                ->get()
        );

        $seoSettings = app(SeoSettings::class);
        $imageSettings = app(ImageSettings::class);

        seo()
            ->title($seoSettings->gallery_title)
            ->description($seoSettings->gallery_description)
            ->url($request->fullUrl());

        // Get hero banner images with fallback to default images
        $heroImage = $imageSettings->gallery_hero
            ? url(Storage::url($imageSettings->gallery_hero))
            : url(Storage::url('default_images/gallery_hero.webp'));
        $heroImageMobile = $imageSettings->gallery_hero_mobile
            ? url(Storage::url($imageSettings->gallery_hero_mobile))
            : url(Storage::url('default_images/gallery_hero_mobile.webp'));

        return view('frontend.pages.gallery.index', [
            'galleryCategories' => $galleryCategories,
            'heroImage' => $heroImage,
            'heroImageMobile' => $heroImageMobile,
        ]);
    }
}
