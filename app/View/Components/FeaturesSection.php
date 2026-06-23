<?php

namespace App\View\Components;

use App\DTOs\Feature\FeatureData;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Modules\Features\Entities\Feature;

class FeaturesSection extends Component
{
    use HasViewVariants;

    public int $limit;

    public string $title;

    public string $subtitle;

    public string $bgImage = '';

    public ?string $bgColor;

    public ?array $categoryIds;

    public $features;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->limit = $data['limit'] ?? 5;
        $this->title = $data['section_title'] ?? 'Features';
        $this->subtitle = $data['section_subtitle'] ?? 'Features';
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';
        $this->categoryIds = $data['category_ids'] ?? null;

        $cacheKey = 'features_section_' . ($this->categoryIds ? implode('_', $this->categoryIds) : 'all');

        $this->features = Cache::remember($cacheKey, 60 * 60, function () {
            return FeatureData::collection(
                Feature::query()
                    ->when($this->categoryIds, function ($query) {
                        return $query->whereIn('category_id', $this->categoryIds);
                    })
                    ->ordered()
                    ->limit($this->limit)
                    ->get()
            );
        });
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
        return 'frontend.components.features_section';
    }
}
