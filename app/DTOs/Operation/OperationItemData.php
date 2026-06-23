<?php

namespace App\DTOs\Operation;

use Illuminate\Support\Facades\Storage;

class OperationItemData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string $title,
        public ?string $description,
        public ?string $icon,
        public ?string $image,
    ) {
        //
    }

    public static function fromArray($item): self
    {
        return new self(
            title: $item['title'],
            description: $item['description'],
            icon: $item['icon'],
            image: $item['image'] ? Storage::url($item['image']) : null,
        );
    }
}
