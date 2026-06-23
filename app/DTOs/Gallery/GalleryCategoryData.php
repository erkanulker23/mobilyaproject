<?php

namespace App\DTOs\Gallery;

use Modules\Gallery\Entities\GalleryCategory;

class GalleryCategoryData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $slug,
        public $entries,
    ) {
        //
    }

    public static function fromModel(GalleryCategory $galleryCategory): self
    {
        // Use loaded relationship if available, otherwise query
        $galleryEntries = $galleryCategory->relationLoaded('galleryEntries')
            ? $galleryCategory->galleryEntries
            : $galleryCategory->galleryEntries()->ordered()->with('media')->get();

        $entries = GalleryEntryData::collection($galleryEntries);

        return new self(
            id: $galleryCategory->id,
            name: $galleryCategory->name,
            slug: $galleryCategory->slug,
            entries: $entries,
        );
    }
}
