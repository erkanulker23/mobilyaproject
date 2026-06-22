<?php

namespace App\Models;

use Biostate\FilamentMenuBuilder\Traits\Menuable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Menuable;

    protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getMenuLinkAttribute(): string
    {
        return url('/urun/' . $this->slug);
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
