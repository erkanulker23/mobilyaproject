<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ThirdPartySettings extends Settings
{
    public ?string $openai_api_key;

    public static function group(): string
    {
        return 'third_party';
    }

    public static function encrypted(): array
    {
        return [
            'openai_api_key',
        ];
    }
}
