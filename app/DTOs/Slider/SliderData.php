<?php

namespace App\DTOs\Slider;

use Modules\Slide\Entities\Slider;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\DataTransferObject\DataTransferObject;

class SliderData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public DataCollection $slides,
    ) {
        //
    }

    public static function fromModel(Slider $slider): self
    {
        $slides = SlideData::collection($slider->slides);

        return new self(
            id: $slider->id,
            title: $slider->title,
            slides: $slides,
        );
    }
}
