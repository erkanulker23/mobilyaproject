<?php

namespace App\View\Components;

use App\DTOs\Faq\FaqData;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Modules\Faq\Entities\Faq;

class FaqsSection extends Component
{
    use HasViewVariants;

    public string $title;

    public string $subtitle;

    public string $bgImage = '';

    public ?string $bgColor;

    public $faqs;
    /**
     * @var int|mixed
     */
    private mixed $faqLimit;
    /**
     * @var int|mixed
     */
    private mixed $faqItemLimit;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $faqIds = $data['faq_ids'];
        $this->faqLimit = $data['faq_limit'] ?? 5;
        $this->faqItemLimit = $data['faq_item_limit'] ?? 5;
        $this->title = $data['section_title'] ?? '';
        $this->subtitle = $data['section_subtitle'] ?? '';
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';

        $faq = Faq::whereIn('id', $faqIds)
                ->when($this->faqLimit, function ($query) {
                    return $query->limit($this->faqLimit);
                })
            ->get();

        $faq->each(function ($item) {
            $item->load(['items' => function ($query) {
                $query->when($this->faqItemLimit, function ($query) {
                    return $query->limit($this->faqItemLimit);
                });
            }]);
        });

        $this->faqs = FaqData::collection($faq);
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
        return 'frontend.components.faqs_section';
    }
}
