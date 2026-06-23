<?php

namespace Modules\References\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Reference extends Model implements Sortable, HasMedia
{
    use HasFactory;
    use SortableTrait;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'logo',
        'order_column',
    ];

    protected static function newFactory()
    {
        return \Modules\References\Database\factories\ReferenceFactory::new();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->useFallbackUrl(url('/defaults/placeholder-image.jpg'))
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(300)
                    ->height(300);
            });
    }

    public function getLogoAttribute()
    {
        // İlk logoyu al (multiple logo destekleniyor)
        $firstLogo = $this->getFirstMedia('logo');
        return $firstLogo ? $firstLogo->getUrl() : url('/defaults/placeholder-image.jpg');
    }
}
