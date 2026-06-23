<?php

namespace App\DTOs\Plan;

use Modules\Plan\Entities\Plan;

class PlanData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $subtitle,
        public ?string $description,
        public ?string $icon,
        public ?string $image,
        public int $order_column,
        public float $monthly_price,
        public float $yearly_price,
        public ?string $currency,
        public ?string $button_text,
        public ?string $button_variant,
        public ?string $button_url,
        public $features,
    ) {
        //
    }

    public static function fromModel(Plan $plan): self
    {

        return new self(
            id: $plan->id,
            title: $plan->title,
            subtitle: $plan->subtitle,
            description: $plan->description,
            icon: $plan->icon,
            image: $plan->image,
            order_column: $plan->order_column,
            monthly_price: $plan->monthly_price,
            yearly_price: $plan->yearly_price,
            currency: $plan->currency,
            button_text: $plan->button_text,
            button_variant: $plan->button_variant,
            button_url: $plan->button_url,
            features: PlanFeatureData::collection($plan->features),
        );
    }
}
