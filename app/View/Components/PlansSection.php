<?php

namespace App\View\Components;

use App\DTOs\Plan\PlanData;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Modules\Plan\Entities\Plan;

class PlansSection extends Component
{
    use HasViewVariants;

    public string $title;

    public string $subtitle;

    public string $bgImage = '';

    public ?string $bgColor;

    public $plans;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->title = $data['section_title'] ?? 'Our Plans';
        $this->subtitle = $data['section_subtitle'] ?? 'Choose the best plan for you';
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';

        $this->plans = PlanData::collection(Plan::all());
    }

    public function render()
    {
        $view = $this->variantViewPath();

        return view($view);
    }

    public function path()
    {
        return 'frontend.components.plans_section';
    }
}
