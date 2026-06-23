<?php

namespace App\DTOs\Faq;

use Modules\Faq\Entities\FaqItem;

class FaqItemData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string $title,
        public ?string $description,
        public ?string $short_description,
        public array $properties,
        public string $slug,
    ) {
        //
    }

    public static function fromModel(FaqItem $faqItem): self
    {
        return new self(
            title: $faqItem->title,
            description: $faqItem->description,
            short_description: $faqItem->short_description,
            properties: $faqItem->properties,
            slug: $faqItem->slug,
        );
    }
}
