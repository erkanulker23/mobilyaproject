<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AdministratorSettings extends Settings
{
    public bool $site_active;

    public bool $frontend_active;

    public string $theme;

    public static function group(): string
    {
        return 'administrator';
    }
}
