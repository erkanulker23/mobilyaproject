<?php

namespace Modules\Filament\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasFilamentSearch
{
    public static function getFilamentSearchLabel()
    {
        return 'name';
    }

    public function scopeFilamentSearch(Builder $query, $search)
    {
        $query->where($this->getFilamentSearchLabel(), 'like', "%{$search}%")->limit(20);
    }

    public function getFilamentSearchOptionName()
    {
        return $this->{$this->getFilamentSearchLabel()};
    }
}
