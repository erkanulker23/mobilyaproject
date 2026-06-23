<?php

namespace App\View\Components;

use App\DTOs\Operation\OperationItemData;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class OperationsSection extends Component
{
    use HasViewVariants;

    public $title = 'Our Operations';

    public $subtitle = 'We are a team of industry experts with years of experience. We are committed to providing the best services to our clients.';

    public $description = '';

    public string $bgImage = '';

    public ?string $bgColor;

    public $operations;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->title = $data['section_title'] ?? $this->title;
        $this->subtitle = $data['section_subtitle'] ?? $this->subtitle;
        $this->description = $data['section_description'] ?? '';
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';
        $this->operations = OperationItemData::collection($data['operations'] ?? []);
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
        return 'frontend.components.operations_section';
    }
}
