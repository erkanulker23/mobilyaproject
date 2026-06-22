<?php

namespace App\Models;

use Biostate\FilamentMenuBuilder\Traits\Menuable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Menuable;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getMenuLinkAttribute(): string
    {
        return url('/koleksiyon/' . $this->slug);
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
