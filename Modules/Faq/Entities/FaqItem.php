<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Faq\Database\Factories\FaqItemFactory;
use Modules\Filament\Traits\HasFilamentSearch;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class FaqItem extends Model
{
    use HasFactory;
    use HasFilamentSearch;
    use HasSlug;
    use HasTranslations;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'properties',
        'slug',
    ];

    public $translatable = [
        'title',
        'description',
        'short_description',
    ];

    protected $casts = [
        'properties' => 'json',
    ];

    public function faqs(): BelongsToMany
    {
        return $this->belongsToMany(Faq::class)->withPivot('order_column');
    }

    protected static function newFactory()
    {
        return FaqItemFactory::new();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
