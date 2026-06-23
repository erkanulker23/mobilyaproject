<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSeoSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('seo.testimonial_title', 'Müşteri Yorumları');
        $this->migrator->add('seo.testimonial_description', 'Müşteri Yorumları');
        $this->migrator->add('seo.contact_title', 'İletişim');
        $this->migrator->add('seo.contact_description', 'İletişim');
        $this->migrator->add('seo.gallery_title', 'Galeri');
        $this->migrator->add('seo.gallery_description', 'Galeri');
        $this->migrator->add('seo.blog_title', 'Blog');
        $this->migrator->add('seo.blog_description', 'Blog');
        $this->migrator->add('seo.services_title', 'Hizmetler');
        $this->migrator->add('seo.services_description', 'Hizmetler');
    }
}
