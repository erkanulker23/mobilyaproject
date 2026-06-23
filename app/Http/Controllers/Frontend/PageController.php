<?php

namespace App\Http\Controllers\Frontend;

use App\DTOs\Page\PageData;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Settings\ImageSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function show(Request $request, Page $page)
    {
        $imageSettings = app(ImageSettings::class);

        seo()
            ->title($page->seo_title ?? $page->title)
            ->description($page->seo_description ?? '')
            ->url($request->fullUrl());

        // Get hero banner images with fallback to default images
        $heroImage = $imageSettings->page_hero
            ? url(Storage::url($imageSettings->page_hero))
            : url(Storage::url('default_images/page_hero.webp'));
        $heroImageMobile = $imageSettings->page_hero_mobile
            ? url(Storage::url($imageSettings->page_hero_mobile))
            : url(Storage::url('default_images/page_hero_mobile.webp'));

        return view('frontend.pages.page.show', [
            'page' => PageData::fromModel($page),
            'heroImage' => $heroImage,
            'heroImageMobile' => $heroImageMobile,
        ]);
    }
}
