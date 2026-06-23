<?php

namespace App\View\Components;

use App\DTOs\Counter\CounterItemData;
use App\Traits\HasViewVariants;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class CountersSection extends Component
{
    use HasViewVariants;

    public string $title;

    public string $subtitle;

    public ?string $bgColor;

    public ?string $bgImage;

    public \Spatie\LaravelData\CursorPaginatedDataCollection|\Spatie\LaravelData\DataCollection|\Spatie\LaravelData\PaginatedDataCollection $counters;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->title = $data['section_title'] ?? '';
        $this->subtitle = $data['section_subtitle'] ?? '';
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';
        $this->counters = CounterItemData::collection($data['counters'] ?? []);
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
        return 'frontend.components.counters_section';
    }
}
