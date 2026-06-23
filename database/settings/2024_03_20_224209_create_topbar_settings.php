<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateTopbarSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('topbar.site_name', 'AWACMS');
        $this->migrator->add('topbar.phone', '+90 000 000 00 00');
        $this->migrator->add('topbar.address', 'Lorem Ipsum Dolor Sit Amet');
        $this->migrator->add('topbar.gsm', '+90 000 000 00 00');
        $this->migrator->add('topbar.email', 'example@example.com');
        $this->migrator->add('topbar.social_media_links', []);
    }
}
