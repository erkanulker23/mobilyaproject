<?php

namespace Modules\Features\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Feature extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',
        'order_column',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(FeatureCategory::class);
    }

    protected static function newFactory()
    {
        return \Modules\Features\Database\factories\FeatureFactory::new();
    }
}
