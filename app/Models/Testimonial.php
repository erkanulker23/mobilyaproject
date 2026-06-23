<?php

namespace App\Models;

use Cog\Flag\Traits\Classic\HasActiveFlag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;

class Testimonial extends Model implements HasMedia, Sortable
{
    use HasActiveFlag;
    use HasFactory;
    use SortableTrait;
    use \Spatie\MediaLibrary\InteractsWithMedia;

    protected $fillable = [
        'name',
        'company',
        'title',
        'description',
        'is_active',
        'order_column',
        'date_at',
        'link',
        'icon',
        'image',
        'rating',
    ];

    protected $casts = [
        'date_at' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
