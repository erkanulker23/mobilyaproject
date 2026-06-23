<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.customer_service_phone');
        $this->migrator->add('general.whatsapp');
        $this->migrator->add('general.google_maps_url');
        $this->migrator->add('general.footer_copyright');
        $this->migrator->add('general.seo_title');
        $this->migrator->add('general.seo_description');
        $this->migrator->add('general.cookie_consent_banner_text');
        $this->migrator->add('general.show_cookie_consent_banner', true);

        $this->migrator->add('general.footer_logo');
        $this->migrator->add('general.dark_footer_logo');
        $this->migrator->add('general.favicon');
        $this->migrator->add('general.dark_header_logo');

        $this->migrator->rename('general.logo_url', 'general.header_logo');
    }
};
