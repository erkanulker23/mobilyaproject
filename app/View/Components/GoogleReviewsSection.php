<?php

namespace App\View\Components;

use App\Traits\HasViewVariants;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Modules\GoogleReview\Entities\GoogleReview;
use Modules\GoogleReview\Entities\GoogleBusiness;

class GoogleReviewsSection extends Component
{
    use HasViewVariants;

    public $reviews;

    public $business;

    public ?string $reviewUrl;

    public int $limit;

    public string $title;

    public string $subtitle;

    public ?string $bgColor;

    public ?string $bgImage;

    public int $minRating;

    public ?int $businessId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $this->limit = $data['limit'] ?? 10;
        $this->title = $data['section_title'] ?? __('googlereview::googlereview.customer_reviews');
        $this->subtitle = $data['section_subtitle'] ?? __('googlereview::googlereview.valued_customer_opinions');
        $this->bgImage = isset($data['bg_image']) ? Storage::url($data['bg_image']) : '';
        $this->bgColor = $data['bg_color'] ?? '';
        $this->minRating = $data['min_rating'] ?? 1;
        $this->businessId = $data['business_id'] ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // with cache
        $cacheKey = "google_reviews_section_{$this->businessId}_{$this->limit}_{$this->minRating}";

        $this->reviews = Cache::remember($cacheKey, 3600, function () {
            $query = GoogleReview::published()
                ->with('business')
                ->minRating($this->minRating)
                ->where(function($q) {
                    $q->where('language', 'tr')
                      ->orWhereNull('language');
                })
                ->ordered();

            // Filter by specific business if selected
            if ($this->businessId) {
                $query->where('google_business_id', $this->businessId);
            } else {
                // Only show reviews from active businesses
                $query->whereHas('business', function ($q) {
                    $q->where('is_active', true);
                });
            }

            return $query->take($this->limit)->get();
        });

        // Get business for review link
        if ($this->businessId) {
            $this->business = GoogleBusiness::find($this->businessId);
        } else {
            $this->business = GoogleBusiness::active()->first();
        }

        // Generate Google review URL
        if ($this->business && $this->business->google_maps_url) {
            $this->reviewUrl = $this->business->google_maps_url . '/reviews';
        } else {
            $this->reviewUrl = '#';
        }

        $view = $this->variantViewPath();

        return view($view);
    }

    public function path()
    {
        return 'frontend.components.google_reviews_section';
    }
}

