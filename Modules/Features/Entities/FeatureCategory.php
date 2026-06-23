<?php

namespace Modules\Features\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}
