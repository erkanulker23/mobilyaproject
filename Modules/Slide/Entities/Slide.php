<?php

namespace Modules\Slide\Entities;

use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Slide extends Model implements HasMedia, Sortable
{
    use HasTranslations;
    use InteractsWithMedia;
    use Publishable;
    use SortableTrait;

    protected $fillable = [
        'title',
        'title_color',
        'show_title_on_mobile',
        'slider_id',
        'subtitle',
        'subtitle_color',
        'show_subtitle_on_mobile',
        'content',
        'content_color',
        'show_content_on_mobile',
        'cta_text',
        'target_id',
        'target_type',
        'link_url',
        'order_column',
        'publish_at',
        'unpublish_at',
    ];

    public $translatable = [
        'title',
        'subtitle',
        'content',
        'cta_text',
        'link_url',
    ];

    protected $cast = [
        'publish_at' => 'datetime',
    ];

    public function target(): MorphTo
    {
        return $this->morphTo();
    }

    public function slider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config('slide.models.slider'));
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
        $this->addMediaCollection('mobile_image')->singleFile();
    }

    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('image');
    }

    public function getMobileImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('mobile_image');
    }
}
