<?php

namespace App\DTOs\Gallery;

use Modules\Gallery\Entities\GalleryEntry;

class GalleryEntryData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $subtitle,
        public ?string $description,
        public ?string $youtube_embed_url,
        public int $order_column,
        public ?string $image,
        public GalleryEntry $model,
    ) {
        //
    }

    public static function fromModel(GalleryEntry $galleryEntry): self
    {
        return new self(
            id: $galleryEntry->id,
            title: $galleryEntry->title,
            subtitle: $galleryEntry->subtitle,
            description: $galleryEntry->description,
            youtube_embed_url: $galleryEntry->youtube_embed_url,
            order_column: $galleryEntry->order_column,
            image: $galleryEntry->getFirstMediaUrl('image'),
            model: $galleryEntry,
        );
    }

    public function getMedia(string $collection = '')
    {
        return $this->model->getMedia($collection);
    }

    public function getFirstMediaUrl(string $collection = '', string $conversion = '')
    {
        return $this->model->getFirstMediaUrl($collection, $conversion);
    }
}
