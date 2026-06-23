<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Faq\Database\Factories\FaqFactory;
use Modules\Filament\Traits\HasFilamentSearch;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory;
    use HasFilamentSearch;
    use HasSlug;
    use HasTranslations;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'slug',
    ];

    public $translatable = [
        'name',
        'description',
    ];

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(FaqItem::class)->withPivot('order_column')->orderByPivot('order_column', 'ASC');
    }

    protected static function newFactory()
    {
        return FaqFactory::new();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
