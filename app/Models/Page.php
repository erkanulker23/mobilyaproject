<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Filament\Traits\HasFilamentSearch;
use Modules\Menu\Traits\Menuable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Page extends Model implements HasMedia, Sitemapable
{
    use HasFactory;
    use HasFilamentSearch;
    use HasSlug;
    use HasTranslations;
    use InteractsWithMedia;
    use Menuable;

    protected $fillable = [
        'slug',
        'title',
        'short_description',
        'seo_title',
        'seo_description',
        'content',
    ];

    public $translatable = [
        'slug',
        'title',
        'short_description',
        'seo_title',
        'seo_description',
        'content',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('details_image')
            ->useFallbackUrl(url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('details_image_mobile')
            ->useFallbackUrl(url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('details_hero')
            ->useFallbackUrl(url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('details_hero_mobile')
            ->useFallbackUrl(url('/defaults/placeholder-image.jpg'));
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

    public static function getFilamentSearchLabel()
    {
        return 'title';
    }

    public function getUrlAttribute()
    {
        return route('page.show', $this->slug);
    }

    public function getMenuLinkAttribute(): string
    {
        return $this->url;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if (in_array($field, $this->translatable, true)) {
            return $this->where($field.'->'.app()->getLocale(), $value)->firstOrFail();
        }

        return parent::resolveRouteBinding($value, $field);
    }

    public function scopeFilamentSearch(Builder $query, $search): void
    {
        $query->whereRaw("LOWER(json_unquote(JSON_EXTRACT(title, '$.tr'))) like LOWER(?)", ["%{$search}%"])->limit(20);
    }

    public function toSitemapTag(): Url | string | array
    {
        return array_map(function ($locale) {
            return Url::create(route('page.show', $this, true, $locale))
                ->setLastModificationDate(Carbon::create($this->updated_at))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.1);
        }, config('filament-spatie-laravel-translatable-plugin.default_locales'));
    }
}
