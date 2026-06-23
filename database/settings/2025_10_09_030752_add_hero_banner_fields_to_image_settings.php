<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddHeroBannerFieldsToImageSettings extends SettingsMigration
{
    public function up(): void
    {
        // Contact Page Hero Banners
        $this->migrator->add('image.contact_hero', null);
        $this->migrator->add('image.contact_hero_mobile', null);

        // Blog Category Page Hero Banners
        $this->migrator->add('image.blog_category_hero', null);
        $this->migrator->add('image.blog_category_hero_mobile', null);

        // Service Listing Page Hero Banners
        $this->migrator->add('image.service_listing_hero', null);
        $this->migrator->add('image.service_listing_hero_mobile', null);

        // Gallery Page Hero Banners
        $this->migrator->add('image.gallery_hero', null);
        $this->migrator->add('image.gallery_hero_mobile', null);

        // Page Hero Banners
        $this->migrator->add('image.page_hero', null);
        $this->migrator->add('image.page_hero_mobile', null);

        // Testimonials Page Hero Banners
        $this->migrator->add('image.testimonials_hero', null);
        $this->migrator->add('image.testimonials_hero_mobile', null);
    }

    public function down(): void
    {
        $this->migrator->delete('image.contact_hero');
        $this->migrator->delete('image.contact_hero_mobile');
        $this->migrator->delete('image.blog_category_hero');
        $this->migrator->delete('image.blog_category_hero_mobile');
        $this->migrator->delete('image.service_listing_hero');
        $this->migrator->delete('image.service_listing_hero_mobile');
        $this->migrator->delete('image.gallery_hero');
        $this->migrator->delete('image.gallery_hero_mobile');
        $this->migrator->delete('image.page_hero');
        $this->migrator->delete('image.page_hero_mobile');
        $this->migrator->delete('image.testimonials_hero');
        $this->migrator->delete('image.testimonials_hero_mobile');
    }
}
