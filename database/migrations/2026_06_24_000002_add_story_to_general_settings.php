<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.story_title', 'Hikayemiz');
        $this->migrator->add('general.story_subtitle', 'AWA Mobilya');
        $this->migrator->add('general.story_text', 'Teknoloji ile el emeğini birleştiren, markalaşmaya önem veren AWA Mobilya; nesillerdir süren bir zanaat ve kalite anlayışıyla yaşam alanlarınıza değer katıyor.');
        $this->migrator->add('general.story_video', null);
        $this->migrator->add('general.story_image', null);
        $this->migrator->add('general.story_button_text', 'Keşfet');
        $this->migrator->add('general.story_button_link', '/kurumsal');
    }

    public function down(): void
    {
        $this->migrator->delete('general.story_title');
        $this->migrator->delete('general.story_subtitle');
        $this->migrator->delete('general.story_text');
        $this->migrator->delete('general.story_video');
        $this->migrator->delete('general.story_image');
        $this->migrator->delete('general.story_button_text');
        $this->migrator->delete('general.story_button_link');
    }
};
