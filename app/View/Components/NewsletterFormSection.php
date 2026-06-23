<?php

namespace App\View\Components;

use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class NewsletterFormSection extends Component
{
    use HasViewVariants;

    public $title = 'Latest Posts';

    public $subtitle = 'Read our latest blog posts';

    public ?string $bgImage = null;

    public ?string $bgColor = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->title = $data['section_title'] ?? $this->title;
        $this->subtitle = $data['section_subtitle'] ?? $this->subtitle;
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : null;
        $this->bgColor = $data['bg_color'] ?? '';
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
        return 'frontend.components.newsletter_form_section';
    }
}
