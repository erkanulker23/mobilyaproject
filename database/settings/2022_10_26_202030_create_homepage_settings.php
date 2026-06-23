<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateHomepageSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('homepage.content', []);
    }
}
