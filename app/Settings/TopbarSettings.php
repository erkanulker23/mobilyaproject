<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TopbarSettings extends Settings
{
    public ?string $address;

    public ?string $phone;

    public ?string $gsm;

    public ?string $email;

    public array $social_media_links;

    public static function group(): string
    {
        return 'topbar';
    }
}
