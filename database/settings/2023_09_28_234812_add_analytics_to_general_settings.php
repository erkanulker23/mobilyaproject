<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.analytics_property_id', '');
        $this->migrator->add('general.analytics_json_file_path', '');
    }
};
