<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'AWACMS');
        $this->migrator->add('general.theme', 'awacms/default');
        $this->migrator->add('general.logo_url', 'defaults/default-logo.png');
        $this->migrator->add('general.phone', '+90 000 000 00 00');
        $this->migrator->add('general.address', 'Lorem Ipsum Dolor Sit Amet');
        $this->migrator->add('general.gsm', '+90 000 000 00 00');
        $this->migrator->add('general.email', 'example@example.com');
    }
}
