<?php

namespace App\View\Components;

use App\DTOs\Counter\CounterItemData;
use App\Traits\HasViewVariants;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class AboutUsSection extends Component
{
    use HasViewVariants;

    public string $title;

    public string $subtitle;

    public string $description;

    public ?string $bgColor;

    public ?string $bgImage;

    public ?string $image;

    public ?string $buttonText;

    public ?string $buttonLink;

    public ?string $buttonIcon;

    public ?string $buttonCustomIcon;

    public array $list;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->title = $data['section_title'] ?? '';
        $this->subtitle = $data['section_subtitle'] ?? '';
        $this->description = $data['section_description'] ?? '';
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->image = isset($data['image']) ? Storage::url($data['image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';

        $this->list = $data['list'] ?? [];

        $this->buttonText = $data['button_text'] ?? '';
        $this->buttonLink = $data['button_link'] ?? '';
        $this->buttonIcon = $data['button_icom'] ?? '';
        $this->buttonCustomIcon = $data['button_custom_icon'] ?? '';
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
        return 'frontend.components.about_us_section';
    }
}
