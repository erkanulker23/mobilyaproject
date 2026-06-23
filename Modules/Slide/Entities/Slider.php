<?php

namespace Modules\Slide\Entities;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'interval',
    ];

    public function slides(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(config('slide.models.slide'));
    }
}
