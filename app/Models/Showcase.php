<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * "Projeler" — ürünlerden bağımsız, ilham veren proje/uygulama showcase'leri.
 */
class Showcase extends Model implements HasMedia, Sortable
{
    use HasSlug;
    use InteractsWithMedia;
    use SortableTrait;

    protected $table = 'showcases';

    protected $fillable = [
        'title', 'slug', 'location', 'year', 'short_description', 'content',
        'is_featured', 'published', 'order_column',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published' => 'boolean',
    ];

    public array $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function getCoverUrlAttribute(): string
    {
        $media = $this->getFirstMedia('cover');

        return $media ? $media->getUrl() : url('/defaults/placeholder-image.jpg');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }
}
