<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateStyleScriptSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('style_script.header_codes', '');
        $this->migrator->add('style_script.scripts', '');
        $this->migrator->add('style_script.styles', '');
    }
}
