<?php

namespace App\DTOs\Testimonial;

use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class TestimonialData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $company,
        public ?string $title,
        public ?string $description,
        public bool $is_active,
        public int $order_column,
        public Carbon $dateAt,
        public ?string $link,
        public ?string $icon,
        public ?string $image,
        public int $rating,
    ) {
        //
    }

    public static function fromModel(Testimonial $testimonial): self
    {
        $rating = $testimonial->rating;
        $image = Storage::url($testimonial->image);

        return new self(
            id: $testimonial->id,
            name: $testimonial->name,
            company: $testimonial->company,
            title: $testimonial->title,
            description: $testimonial->description,
            is_active: $testimonial->is_active,
            order_column: $testimonial->order_column,
            dateAt: $testimonial->date_at,
            link: $testimonial->link,
            icon: $testimonial->icon,
            image: $image,
            rating: $rating,
        );
    }
}
