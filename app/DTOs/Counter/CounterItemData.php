<?php

namespace App\DTOs\Counter;

use Illuminate\Support\Facades\Storage;

class CounterItemData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string $title,
        public ?string $description,
        public ?string $icon,
        public int $value,
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
            value: (int) $item['value'],
            image: $item['image'] ? Storage::url($item['image']) : null,
        );
    }
}
