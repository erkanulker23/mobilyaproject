<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class RefactorTheme extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->rename('general.theme', 'administrator.theme');
    }
}
