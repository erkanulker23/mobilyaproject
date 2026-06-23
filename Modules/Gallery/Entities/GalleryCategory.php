<?php

namespace Modules\Gallery\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class GalleryCategory extends Model implements Sortable
{
    use HasFactory;
    use HasSlug;
    use SortableTrait;

    protected $fillable = [
        'name',
        'slug',
        'is_listable',
    ];

    protected $casts = [
        'is_listable' => 'boolean',
    ];

    public function galleryEntries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GalleryEntry::class);
    }

    protected static function newFactory()
    {
        return \Modules\Gallery\Database\factories\GalleryCategoryFactory::new();
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
