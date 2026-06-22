<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\News;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Testimonial;

class HomeController extends FrontendController
{
    public function index()
    {
        $this->boot();

        $settings = \App\Models\Setting::pluck('value', 'key');
        $show = fn ($key) => ($settings[$key] ?? '1') !== '0';

        return view('frontend.home', [
            'slides'       => Slide::with('product')->orderBy('sort')->get(),
            'categories'   => Category::orderBy('sort')->withCount('products')->get(),
            'products'     => Product::with('category')->orderBy('sort')->get(),
            'news'         => News::orderBy('sort')->take(3)->get(),
            'testimonials' => Testimonial::where('is_active', true)->orderBy('sort')->get(),
            'show'         => [
                'catalog'      => $show('homeCatalog'),
                'collections'  => $show('homeCollections'),
                'news'         => $show('homeNews'),
                'testimonials' => $show('homeTestimonials'),
            ],
        ]);
    }
}
