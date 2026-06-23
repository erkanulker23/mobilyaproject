<?php

namespace App\Models;

use Cog\Flag\Traits\Classic\HasActiveFlag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Kalnoy\Nestedset\NodeTrait;
use Modules\Filament\Traits\HasFilamentSearch;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ServiceCategory extends Model implements HasMedia, Sitemapable
{
    use HasActiveFlag;
    use HasFilamentSearch;
    use HasSlug;
    use InteractsWithMedia;
    use NodeTrait;

    protected $fillable = [
        'slug',
        'name',
        'short_description',
        'seo_title',
        'seo_description',
        'content',
        'order_column',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(ServicePost::class, 'service_post_categories')
            ->using(ServicePostCategory::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('category_details_image');
        $this->addMediaCollection('category_details_hero');
        $this->addMediaCollection('category_icon');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getUrlAttribute()
    {
        return route('services-category.index', ['serviceCategory' => $this->slug]);
    }

    public function toSitemapTag(): Url | string | array
    {
        return array_map(function ($locale) {
            return Url::create(route('services-category.index', $this, true, $locale))
                ->setLastModificationDate(Carbon::create($this->updated_at))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.1);
        }, config('filament-spatie-laravel-translatable-plugin.default_locales'));
    }
}
