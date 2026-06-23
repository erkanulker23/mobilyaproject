<?php

namespace App\View\Components\GoogleReview;

use Illuminate\View\Component;
use Modules\GoogleReview\Entities\GoogleReviewWidget;

class Widget extends Component
{
    public $widget;
    public $reviews;
    public $settings;

    /**
     * Create a new component instance.
     *
     * @param int $widgetId
     */
    public function __construct($widgetId)
    {
        $this->widget = GoogleReviewWidget::active()->findOrFail($widgetId);
        $this->reviews = $this->widget->getReviews();
        $this->settings = $this->widget->getSettings();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        // Determine the view based on layout type and style variant
        $viewName = sprintf(
            'googlereview::frontend.widgets.%s.%s',
            $this->widget->layout_type,
            $this->widget->style_variant
        );

        // Fallback to a generic view if specific one doesn't exist
        if (!view()->exists($viewName)) {
            $viewName = sprintf(
                'googlereview::frontend.widgets.%s.variant_1',
                $this->widget->layout_type
            );
        }

        return view($viewName);
    }
}

