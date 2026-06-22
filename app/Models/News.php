<?php

namespace App\Models;

use Biostate\FilamentMenuBuilder\Traits\Menuable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Menuable;

    protected $table = 'news';

    protected $guarded = [];

    public function getMenuLinkAttribute(): string
    {
        return url('/haber/' . $this->slug);
    }

    public function getMenuNameAttribute(): string
    {
        return (string) $this->tr;
    }

    public static function getFilamentSearchLabel(): string
    {
        return 'tr';
    }
}
