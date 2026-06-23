<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.working_hours', 'Pazartesi - Cuma: 09:00 - 18:00');
    }
};
