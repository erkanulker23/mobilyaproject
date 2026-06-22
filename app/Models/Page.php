<?php

namespace App\Models;

use Biostate\FilamentMenuBuilder\Traits\Menuable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Menuable;

    protected $guarded = [];

    public function getMenuLinkAttribute(): string
    {
        return url('/' . $this->key);
    }

    public function getMenuNameAttribute(): string
    {
        return (string) $this->t_tr;
    }

    public static function getFilamentSearchLabel(): string
    {
        return 't_tr';
    }
}
