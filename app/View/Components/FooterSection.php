<?php

namespace App\View\Components;

use App\DTOs\Member\SocialMediaLinkData;
use App\DTOs\Menu\MenuData;
use App\DTOs\Testimonial\TestimonialData;
use App\Settings\GeneralSettings;
use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class FooterSection extends Component
{
    use HasViewVariants;

    public int $menuId;

    public MenuData $menu;

    public ?string $phone;

    public \Spatie\LaravelData\DataCollection|\Spatie\LaravelData\CursorPaginatedDataCollection|\Spatie\LaravelData\PaginatedDataCollection $socialMediaLinks;

    public ?string $wrapperClass;

    public ?string $bgColor;
    public ?string $bgImage;
    public ?string $bgGradient;

    // Configurable colors and description
    public ?string $linkColor;
    public ?string $titleColor;
    public ?string $widgetColor;
    public ?string $logoDescription;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->menuId = $data['menu_id'];
        $this->phone = $data['phone'] ?? null;
        $this->wrapperClass = $data['wrapper_class'] ?? null;
        $this->bgColor = $data['bg_color'] ?? null;
        $this->bgImage = $data['bg_image'] ?? null;
        $this->bgGradient = $data['bg_gradient'] ?? null;
        $this->linkColor = $data['link_color'] ?? null; // hex or css color
        $this->titleColor = $data['title_color'] ?? null; // hex or css color
        $this->widgetColor = $data['widget_color'] ?? null; // hex or css color
        $this->logoDescription = $data['logo_description'] ?? null;

        $settings = app(GeneralSettings::class);
        $this->menu = MenuData::from((int) $data['menu_id']);
        $this->socialMediaLinks = SocialMediaLinkData::collection($settings->social_media_links);
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
        return 'frontend.components.footer_section';
    }
}
