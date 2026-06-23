<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.header_menu', null);
        $this->migrator->add('general.header_mobile_menu', null);
        $this->migrator->add('general.footer_menu', null);
        $this->migrator->add('general.footer_mobile_menu', null);
    }
};
