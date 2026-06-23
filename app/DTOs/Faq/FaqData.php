<?php

namespace App\DTOs\Faq;

use Modules\Faq\Entities\Faq;
use Spatie\LaravelData\Lazy;

class FaqData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public string $slug,
        public $items
    ) {
        //
    }

    public static function fromModel(Faq $faq): self
    {
        $items = FaqItemData::collection($faq->items);

        return new self(
            id: $faq->id,
            name: $faq->name,
            description: $faq->description,
            slug: $faq->slug,
            items: $items,
        );
    }
}
