<?php

namespace App\View\Components;

use App\Models\Project;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class ProjectsSection extends Component
{
    use HasViewVariants;

    public ?string $title;

    public ?string $subtitle;

    public ?string $eyebrow;

    public ?string $bgColor;

    public ?string $bgImage;

    public ?string $buttonText;

    public ?string $buttonUrl;

    public bool $onlyFeatured;

    public bool $showFilter;

    public int $limit;

    public $projects;

    public function __construct(public array $data = [])
    {
        $this->title = $data['section_title'] ?? 'Hayata geçirdiğimiz eserler';
        $this->subtitle = $data['section_subtitle'] ?? null;
        $this->eyebrow = $data['eyebrow'] ?? 'Projelerimiz';
        $this->bgColor = $data['bg_color'] ?? '#F4EFE7';
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->buttonText = $data['button_text'] ?? 'Tüm Projeler';
        $this->buttonUrl = $data['button_url'] ?? null;
        $this->onlyFeatured = (bool) ($data['only_featured'] ?? false);
        $this->showFilter = (bool) ($data['show_filter'] ?? true);
        $this->limit = (int) ($data['limit'] ?? 6);

        $query = Project::published()->with('projectCategory')->orderBy('order_column');
        if ($this->onlyFeatured) {
            $query->where('is_featured', true);
        }
        $this->projects = $query->take($this->limit)->get();
    }

    public function render()
    {
        return view($this->variantViewPath());
    }

    public function path()
    {
        return 'frontend.components.projects_section';
    }
}
