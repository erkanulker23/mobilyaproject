<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreatePopupSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('popup.title', 'AWACMS');
        $this->migrator->add('popup.is_active', 0);
        $this->migrator->add('popup.cookie_days', 7);
        $this->migrator->add('popup.content', 'Lorem Ipsum Dolor Sit Amet');
        $this->migrator->add('popup.button_text', 'Lorem Ipsum Dolor Sit Amet');
        $this->migrator->add('popup.button_url', 'Lorem Ipsum Dolor Sit Amet');
        $this->migrator->add('popup.button_class', 'Lorem Ipsum Dolor Sit Amet');
    }
}
