<?php

namespace App\View\Components;

use App\DTOs\Blog\BlogPostData;
use App\Models\BlogPost;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class LatestBlogPostSection extends Component
{
    use HasViewVariants;
    public string $title = 'Latest Blog Post';

    public string $subtitle = 'Read our latest blog post';

    public $post;

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
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';
        $categories = $data['category_id'] ?? null;

        $postModel = BlogPost::query()
            ->published()
            ->latest()
            ->when(! empty($categories), fn ($query) => $query->whereHas('categories', fn ($q) => $q->whereIn('blog_categories.id', $categories)))
            ->with('categories', 'media')
            ->first();

        if (! $postModel) {
            return;
        }

        $this->post = BlogPostData::from($postModel);
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
        return 'frontend.components.latest_blog_post_section';
    }
}
