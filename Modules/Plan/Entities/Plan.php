<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'icon',
        'image',
        'order_column',
        'monthly_price',
        'yearly_price',
        'currency',
        'button_text',
        'button_variant',
        'button_url',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    protected static function newFactory()
    {
        return \Modules\Plan\Database\factories\PlanFactory::new();
    }
}
