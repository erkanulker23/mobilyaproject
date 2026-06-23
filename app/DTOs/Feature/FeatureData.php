<?php

namespace App\DTOs\Feature;

use Illuminate\Support\Facades\Storage;
use Modules\Features\Entities\Feature;

class FeatureData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $description,
        public ?string $icon,
        public ?string $image,
        public int $order_column,
    ) {
        //
    }

    public static function fromModel(Feature $feature): self
    {
        return new self(
            id: $feature->id,
            title: $feature->title,
            description: $feature->description,
            icon: $feature->icon,
            image: Storage::url($feature->image),
            order_column: $feature->order_column,
        );
    }
}
