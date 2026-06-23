<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Kalnoy\Nestedset\NodeTrait;
use Modules\Filament\Traits\HasFilamentSearch;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogCategory extends Model implements HasMedia
{
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
        return $this->belongsToMany(BlogPost::class, 'blog_post_categories')
            ->using(BlogPostCategory::class);
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
        return route('blog.index', ['category' => $this->slug]);
    }
}
