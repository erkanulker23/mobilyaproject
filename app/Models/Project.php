<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model implements HasMedia, Sortable
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;
    use SortableTrait;

    protected $fillable = [
        'title', 'slug', 'category', 'project_category_id', 'location', 'status', 'is_sale',
        'client', 'area', 'year', 'short_description', 'content',
        'specs', 'is_featured', 'published', 'order_column',
    ];

    protected $casts = [
        'specs' => 'array',
        'is_sale' => 'boolean',
        'is_featured' => 'boolean',
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

    public function projectCategory()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    /** Frontend gösterimi için kategori adı (ilişki → yoksa string fallback). */
    public function getCategoryLabelAttribute(): ?string
    {
        if ($this->relationLoaded('projectCategory') || $this->project_category_id) {
            $name = optional($this->projectCategory)->name;
            if ($name) {
                return $name;
            }
        }
        return $this->category ? \Illuminate\Support\Str::title($this->category) : null;
    }

    /** Filtre (data-cat) için kategori slug'ı. */
    public function getCategoryFilterAttribute(): ?string
    {
        return optional($this->projectCategory)->slug ?: $this->category;
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

        $this->addMediaCollection('gallery');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(700)->height(525)->nonQueued();
    }

    public function getCoverUrlAttribute(): string
    {
        $media = $this->getFirstMedia('cover');
        return $media ? $media->getUrl() : url('/defaults/placeholder-image.jpg');
    }

    public function getCoverThumbAttribute(): string
    {
        $media = $this->getFirstMedia('cover');
        return $media ? $media->getUrl('thumb') : url('/defaults/placeholder-image.jpg');
    }

    public function getGalleryUrlsAttribute(): array
    {
        return $this->getMedia('gallery')->map(fn ($m) => $m->getUrl())->all();
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->status === 'tamam' ? 'Tamamlandı' : 'Devam Ediyor';
    }

    public function getStatusColorAttribute(): string
    {
        return $this->status === 'tamam' ? '#1F9D6B' : '#E8852C';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }
}
