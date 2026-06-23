<?php

namespace App\Models;

use App\Settings\ImageSettings;
use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Modules\Filament\Traits\HasFilamentSearch;
use Modules\Menu\Traits\Menuable;
use Shetabit\Visitor\Traits\Visitable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class ServicePost extends Model implements HasMedia, Sortable, Sitemapable
{
    use HasFactory;
    use HasFilamentSearch;
    use HasSlug;
    use HasTranslations;
    use InteractsWithMedia;
    use Menuable;
    use Publishable;
    use SortableTrait;
    use Visitable;

    protected $fillable = [
        'slug',
        'title',
        'short_description',
        'icon',
        'custom_icon',
        'seo_title',
        'seo_description',
        'content',
        'publish_at',
        'unpublish_at',
        'jotform_id',
    ];

    public $translatable = [
        'title',
        'short_description',
        'seo_title',
        'seo_description',
        'content',
        'slug',
    ];

    protected $casts = [
        'publish_at' => 'datetime',
        'unpublish_at' => 'datetime',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ServiceCategory::class, 'service_post_categories')
            ->using(ServicePostCategory::class);
    }

    public function registerMediaCollections(): void
    {
        $imageSettings = app(ImageSettings::class);

        $this->addMediaCollection('details_image')
            ->useFallbackUrl($imageSettings->service_details_image ? url(Storage::url($imageSettings->service_details_image)) : url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('details_image_mobile')
            ->useFallbackUrl($imageSettings->service_details_image_mobile ? url(Storage::url($imageSettings->service_details_image_mobile)) : url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('details_hero')
            ->useFallbackUrl($imageSettings->service_details_hero ? url(Storage::url($imageSettings->service_details_hero)) : url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('details_hero_mobile')
            ->useFallbackUrl($imageSettings->service_details_hero_mobile ? url(Storage::url($imageSettings->service_details_hero_mobile)) : url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('listing_image')
            ->useFallbackUrl($imageSettings->service_listing_image ? url(Storage::url($imageSettings->service_listing_image)) : url('/defaults/placeholder-image.jpg'));
        $this->addMediaCollection('listing_image_mobile')
            ->useFallbackUrl($imageSettings->service_listing_image_mobile ? url(Storage::url($imageSettings->service_listing_image_mobile)) : url('/defaults/placeholder-image.jpg'));
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
        return route('services.show', $this->slug);
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
            return Url::create(route('services.show', $this, true, $locale))
                ->setLastModificationDate(Carbon::create($this->updated_at))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.1);
        }, config('filament-spatie-laravel-translatable-plugin.default_locales'));
    }
}
