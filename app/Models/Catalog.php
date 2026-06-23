<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Catalog extends Model implements HasMedia, Sortable
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;
    use SortableTrait;

    protected $fillable = [
        'title', 'slug', 'description', 'file_size', 'year',
        'published', 'order_column',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public array $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile()
            ->useFallbackUrl(url('/defaults/placeholder-image.jpg'));

        $this->addMediaCollection('file')
            ->singleFile()
            ->acceptsMimeTypes(['application/pdf']);
    }

    public function getCoverUrlAttribute(): string
    {
        $media = $this->getFirstMedia('cover');
        return $media ? $media->getUrl() : url('/defaults/placeholder-image.jpg');
    }

    public function getFileUrlAttribute(): ?string
    {
        $media = $this->getFirstMedia('file');
        return $media ? $media->getUrl() : null;
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }
}
