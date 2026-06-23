<?php

namespace App\View\Components;

use App\DTOs\Faq\FaqData;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Modules\Faq\Entities\Faq;

class FaqSection extends Component
{
    use HasViewVariants;

    public int $limit;

    public string $title;

    public string $subtitle;

    public string $bgImage = '';

    public ?string $bgColor;

    public $faq;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->faqId = $data['faq_id'];
        $this->limit = $data['limit'] ?? 5;
        $this->title = $data['section_title'] ?? 'Testimonials';
        $this->subtitle = $data['section_subtitle'] ?? 'Testimonials';
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';

        $faq = Faq::where('id', $this->faqId)->first();
        $faq->load(['items' => function ($query) {
            $query->limit($this->limit);
        }]);

        $this->faq = FaqData::from($faq);
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
        return 'frontend.components.faq_section';
    }
}
