<?php

namespace Modules\Group\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Group extends Model
{
    use HasSlug;
    use HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
    ];

    protected $translatable = [
        'title',
        'subtitle',
        'description',
    ];

    public function groupables(): HasMany
    {
        return $this->hasMany(Groupable::class);
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
