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

class HeaderSection extends Component
{
    use HasViewVariants;

    public int $menuId;

    public ?string $buttonText;

    public ?string $buttonLink;

    public ?string $buttonIcon;

    public ?string $buttonCustomIcon;

    public MenuData $menu;

    public ?string $phone;

    public ?string $width;

    public \Spatie\LaravelData\DataCollection|\Spatie\LaravelData\CursorPaginatedDataCollection|\Spatie\LaravelData\PaginatedDataCollection $socialMediaLinks;

    public ?string $wrapperClass;

    public ?string $bgColor;

    public ?string $topbarViewVariant;
    public ?string $topbarText;
    public bool $isTopbarActive;
    public bool $showAddress;
    public bool $showPhone;
    public bool $showSocial;
    public bool $isTransparent;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->menuId = $data['menu_id'];
        $this->buttonText = $data['button_text'] ?? null;
        $this->buttonLink = $data['button_link'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->buttonIcon = $data['button_icon'] ?? null;
        $this->buttonCustomIcon = $data['button_custom_icon'] ?? null;
        $this->width = $data['width'] ?? null;
        $this->wrapperClass = $data['wrapper_class'] ?? null;
        $this->bgColor = $data['bg_color'] ?? null;

        $this->topbarViewVariant = $data['topbar_view_variant'] ?? 'variant_1';
        $this->topbarText = isset($data['topbar_text']) ? preg_replace('/^<p>|<\/p>$/', '', $data['topbar_text']) : null;
        $this->isTopbarActive = $data['is_topbar_active'] ?? false;
        $this->showAddress = $data['show_address'] ?? false;
        $this->showPhone = $data['show_phone'] ?? false;
        $this->showSocial = $data['show_social'] ?? false;
        // Header sadece anasayfada saydam olsun
        $this->isTransparent = (bool)($data['is_transparent'] ?? false) && request()->routeIs('home');


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
        return 'frontend.components.header_section';
    }
}
