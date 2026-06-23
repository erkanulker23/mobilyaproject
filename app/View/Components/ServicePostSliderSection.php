<?php

namespace App\View\Components;

use App\DTOs\Service\ServicePostData;
use App\Models\ServicePost;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class ServicePostSliderSection extends Component
{
    use HasViewVariants;

    public ?string $title;

    public ?string $subtitle;

    public ?string $bgImage = '';

    public ?int $servicePostCategoryId = null;

    public int $limit;

    public ?string $buttonText;

    public ?string $buttonUrl;

    public ?string $bgColor;

    public $servicePosts;

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
        $this->servicePostCategoryId = $data['service_category_id'] ?? null;
        $this->limit = $data['limit'] ?? 5;
        $this->buttonText = $data['button_text'] ?? null;
        $this->buttonUrl = $data['button_url'] ?? null;
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';

        $servicePosts = ServicePost::query()
            ->published()
            ->when($this->servicePostCategoryId, function ($query, $servicePostCategory) {
                return $query->whereHas('categories', function ($query) use ($servicePostCategory) {
                    $query->where('service_categories.id', $servicePostCategory);
                });
            })
            ->orderBy('publish_at', 'desc')
            ->limit($this->limit)
            ->with('media', 'categories')
            ->get();

        $this->servicePosts = ServicePostData::collection($servicePosts);
    }

    public function render()
    {
        $view = $this->variantViewPath();

        return view($view);
    }

    public function path()
    {
        return 'frontend.components.service_post_slider_section';
    }
}
