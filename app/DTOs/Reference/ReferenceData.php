<?php

namespace App\DTOs\Reference;

use Illuminate\Support\Facades\Storage;
use Modules\References\Entities\Reference;

class ReferenceData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $logo,
        public int $order_column,
    ) {
        //
    }

    public static function fromModel(Reference $reference): self
    {
        // Eğer media library'de resim varsa onu kullan, yoksa eski logo field'ını kullan
        $logo = $reference->getFirstMediaUrl('logo');

        if (! $logo) {
            $logo = $reference->logo ? Storage::url($reference->logo) : '/defaults/placeholder-image.jpg';
        }

        return new self(
            id: $reference->id,
            title: $reference->title,
            logo: $logo,
            order_column: $reference->order_column,
        );
    }
}
