<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PopupSettings extends Settings
{
    public ?string $title;

    public bool $is_active;

    public int $cookie_days;

    public ?string $content;

    public ?string $button_text;

    public ?string $button_url;

    public ?string $button_class;

    public static function group(): string
    {
        return 'popup';
    }
}
