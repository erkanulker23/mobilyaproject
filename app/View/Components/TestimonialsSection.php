<?php

namespace App\View\Components;

use App\DTOs\Testimonial\TestimonialData;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class TestimonialsSection extends Component
{
    use HasViewVariants;

    public $testimonials;

    public int $limit;

    public string $title;

    public string $subtitle;

    public ?string $bgColor;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->limit = $data['limit'] ?? 5;
        $this->title = $data['section_title'] ?? 'Testimonials';
        $this->subtitle = $data['section_subtitle'] ?? 'Testimonials';
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // with cache
        $this->testimonials = Cache::remember('testimonials_list', 60 * 60, function () {
            $models = \App\Models\Testimonial::latest('date_at')->active()->take($this->limit)->get();

            return TestimonialData::collection($models);
        });

        $view = $this->variantViewPath();

        return view($view);
    }

    public function path()
    {
        return 'frontend.components.testimonials_section';
    }
}
