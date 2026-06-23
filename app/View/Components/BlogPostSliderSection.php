<?php

namespace App\View\Components;

use App\DTOs\Blog\BlogPostData;
use App\Models\BlogPost;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class BlogPostSliderSection extends Component
{
    use HasViewVariants;

    public $posts;

    public $limit = 3;

    public $title = 'Latest Posts';

    public $subtitle = 'Read our latest blog posts';

    public string $bgImage = '';

    public ?string $bgColor;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->title = $data['section_title'] ?? $this->title;
        $this->subtitle = $data['section_subtitle'] ?? $this->subtitle;
        $this->limit = $data['limit'] ?? $this->limit;
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';
        $categories = $data['category_id'] ?? null;

        $postModels = BlogPost::query()
            ->published()
            ->limit($this->limit)
            ->latest()
            ->when(! empty($categories), fn ($query) => $query->whereHas('categories', fn ($q) => $q->whereIn('blog_categories.id', $categories)))
            ->with('categories', 'media')
            ->get();

        $this->posts = $postModels->map(fn ($post) => BlogPostData::from($post));
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
        return 'frontend.components.blog_post_slider_section';
    }
}
