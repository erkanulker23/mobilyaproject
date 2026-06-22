<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    /** Return all settings as a flat key => value associative array. */
    public static function allFlat(): array
    {
        return static::query()->pluck('value', 'key')->toArray();
    }

    /** Get a single setting value. */
    public static function get(string $key, $default = null)
    {
        $row = static::query()->where('key', $key)->first();

        return $row ? $row->value : $default;
    }

    /** Create or update a setting. */
    public static function put(string $key, $value, string $group = 'general'): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }
}
