<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class EmailSettings extends Settings
{
    public string $username;

    public string $password;

    public string $host;

    public string $port;

    public string $from_address;

    public string $from_name;

    public bool $encryption;

    public static function group(): string
    {
        return 'email';
    }
}
