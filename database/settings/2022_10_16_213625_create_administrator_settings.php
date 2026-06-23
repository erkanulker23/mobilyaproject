<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateAdministratorSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('administrator.site_active', true);
        $this->migrator->add('administrator.frontend_active', true);
    }
}
