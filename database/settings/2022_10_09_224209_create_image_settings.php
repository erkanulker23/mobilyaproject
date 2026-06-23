<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateImageSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('image.blog_details_image', null);
        $this->migrator->add('image.blog_details_hero', null);
        $this->migrator->add('image.blog_listing_image', null);
        $this->migrator->add('image.service_details_image', null);
        $this->migrator->add('image.service_details_hero', null);
        $this->migrator->add('image.service_listing_image', null);
    }

    public function down(): void
    {
        $this->migrator->delete('image.blog_details_image');
        $this->migrator->delete('image.blog_details_hero');
        $this->migrator->delete('image.blog_listing_image');
        $this->migrator->delete('image.service_details_image');
        $this->migrator->delete('image.service_details_hero');
        $this->migrator->delete('image.service_listing_image');
    }
}
