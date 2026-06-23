<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ImageSettings extends Settings
{
    public $blog_details_image;

    public $blog_details_image_mobile;

    public $blog_details_hero;

    public $blog_details_hero_mobile;

    public $blog_listing_image;

    public $blog_listing_image_mobile;

    public $service_details_image;

    public $service_details_image_mobile;

    public $service_details_hero;

    public $service_details_hero_mobile;

    public $service_listing_image;

    public $service_listing_image_mobile;

    // Contact Page Hero Images
    public $contact_hero;

    public $contact_hero_mobile;

    // Blog Category/Listing Page Hero Images
    public $blog_category_hero;

    public $blog_category_hero_mobile;

    // Service Listing Page Hero Images
    public $service_listing_hero;

    public $service_listing_hero_mobile;

    // Gallery Page Hero Images
    public $gallery_hero;

    public $gallery_hero_mobile;

    // Page Hero Images
    public $page_hero;

    public $page_hero_mobile;

    // Testimonials Page Hero Images
    public $testimonials_hero;

    public $testimonials_hero_mobile;

    public static function group(): string
    {
        return 'image';
    }
}
