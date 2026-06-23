<?php

namespace App\View\Components;

use App\DTOs\Service\ServiceCategoryData;
use App\DTOs\Service\ServicePostData;
use App\Models\ServiceCategory;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class ServiceCategorySliderSection extends Component
{
    use HasViewVariants;

    public ?string $title;

    public ?string $subtitle;

    public ?string $bgImage = '';

    public ?array $selectedCategoryIds;

    public int $limit;

    public ?string $buttonText;

    public ?string $buttonUrl;

    public ?string $bgColor;

    public $serviceCategories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public array $data = [],
    ) {
        $this->title = $data['section_title'] ?? null;
        $this->subtitle = $data['section_subtitle'] ?? null;
        $this->selectedCategoryIds = $data['service_category_ids'] ?? null;
        $this->limit = $data['limit'] ?? 5;
        $this->buttonText = $data['button_text'] ?? null;
        $this->buttonUrl = $data['button_url'] ?? null;
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';

        $serviceCategories = ServiceCategory::query()
            ->when($this->selectedCategoryIds, function ($query) {
                return $query->whereIn('id', $this->selectedCategoryIds);
            })
            ->with('media')
            ->limit($this->limit)
            ->get();

        $this->serviceCategories = ServiceCategoryData::collection($serviceCategories);
    }

    public function render()
    {
        $view = $this->variantViewPath();

        return view($view);
    }

    public function path()
    {
        return 'frontend.components.service_category_slider_section';
    }
}
