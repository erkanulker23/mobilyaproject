<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.robots_txt', "User-agent: *\nDisallow:\n");
    }

    public function down(): void
    {
        $this->migrator->delete('general.robots_txt');
    }
};
