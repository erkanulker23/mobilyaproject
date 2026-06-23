<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeoSettings extends Settings
{
    public ?string $testimonial_title = null;

    public ?string $testimonial_description = null;

    public ?string $contact_title = null;

    public ?string $contact_description = null;

    public ?string $gallery_title = null;

    public ?string $gallery_description = null;

    public ?string $blog_title = null;

    public ?string $blog_description = null;

    public ?string $services_title = null;

    public ?string $services_description = null;

    public static function group(): string
    {
        return 'seo';
    }
}
