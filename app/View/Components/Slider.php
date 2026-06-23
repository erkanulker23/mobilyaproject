<?php

namespace App\View\Components;

use App\Traits\HasViewVariants;
use Illuminate\View\Component;
use Modules\Slide\Entities\Slider as SliderModel;

class Slider extends Component
{
    use HasViewVariants;

    public $slider;

    public ?string $wrapperClass = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $slider = SliderModel::whereKey($data['slider_id'])
            ->with(['slides' => function ($query) {
                $query->with('target.media')->ordered()->published();
            }, 'slides.media'])
            ->first();

        $this->slider = \App\DTOs\Slider\SliderData::fromModel($slider);
        $this->wrapperClass = $data['wrapper_class'] ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $view = $this->variantViewPath();

        return view($view);
    }

    public function path()
    {
        return 'frontend.components.slider';
    }
}
