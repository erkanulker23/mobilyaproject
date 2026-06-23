<?php

namespace App\DTOs\Plan;

class PlanFeatureData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string $name,
        public ?string $icon,
        public ?string $customIcon,
        public ?string $extraClass
    ) {
        //
    }

    public static function fromArray($feature): self
    {
        $feature = collect($feature);
        $icon = $feature->get('icon');
        $customIcon = $feature->get('custom_icon');
        $name = $feature->get('name');
        $extraClass = $feature->get('extra_class');

        return new self(
            name: $name,
            icon: $icon,
            customIcon: $customIcon,
            extraClass: $extraClass,
        );
    }
}
