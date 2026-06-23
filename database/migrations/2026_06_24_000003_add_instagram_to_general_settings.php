<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.instagram_username', 'awamobilya');
        $this->migrator->add('general.instagram_url', 'https://instagram.com/awamobilya');
        $this->migrator->add('general.instagram_posts', []);
    }

    public function down(): void
    {
        $this->migrator->delete('general.instagram_username');
        $this->migrator->delete('general.instagram_url');
        $this->migrator->delete('general.instagram_posts');
    }
};
