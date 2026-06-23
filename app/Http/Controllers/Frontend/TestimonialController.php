<?php

namespace App\Http\Controllers\Frontend;

use App\DTOs\Testimonial\TestimonialData;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Settings\ImageSettings;
use App\Settings\SeoSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $testimonialPaginated = Testimonial::query()
            ->ordered()
            ->where('is_active', 1)
            ->paginate();

        $testimonials = TestimonialData::collection($testimonialPaginated);

        $seoSettings = app(SeoSettings::class);
        $imageSettings = app(ImageSettings::class);

        seo()
            ->title($seoSettings->testimonial_title)
            ->description($seoSettings->testimonial_description)
            ->url($request->fullUrl());

        // Get hero banner images with fallback to default images
        $heroImage = $imageSettings->testimonials_hero
            ? url(Storage::url($imageSettings->testimonials_hero))
            : url(Storage::url('default_images/testimonials_hero.webp'));
        $heroImageMobile = $imageSettings->testimonials_hero_mobile
            ? url(Storage::url($imageSettings->testimonials_hero_mobile))
            : url(Storage::url('default_images/testimonials_hero_mobile.webp'));

        return view('frontend.pages.testimonial.index', [
            'testimonials' => $testimonials,
            'testimonialPaginated' => $testimonialPaginated,
            'heroImage' => $heroImage,
            'heroImageMobile' => $heroImageMobile,
        ]);
    }
}
