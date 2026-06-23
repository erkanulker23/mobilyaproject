<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class StyleScriptSettings extends Settings
{
    public ?string $header_codes;

    public ?string $scripts;

    public ?string $styles;

    public static function group(): string
    {
        return 'style_script';
    }
}
