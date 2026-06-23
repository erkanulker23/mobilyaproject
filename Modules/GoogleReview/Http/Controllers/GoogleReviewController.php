<?php

namespace Modules\GoogleReview\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GoogleReview\Entities\GoogleReview;
use Modules\GoogleReview\Entities\GoogleReviewWidget;

class GoogleReviewController extends Controller
{
    /**
     * Display a listing of all published reviews
     * @return Renderable
     */
    public function index(Request $request)
    {
        $minRating = $request->get('min_rating', 1);
        $perPage = $request->get('per_page', 12);

        $reviews = GoogleReview::published()
            ->minRating($minRating)
            ->ordered()
            ->paginate($perPage);

        return view('googlereview::frontend.index', compact('reviews'));
    }

    /**
     * Display a specific widget
     * @param int $id
     * @return Renderable
     */
    public function widget($id)
    {
        $widget = GoogleReviewWidget::active()->findOrFail($id);
        $reviews = $widget->getReviews();

        // Determine the view based on layout type and style variant
        $viewName = sprintf(
            'googlereview::frontend.widgets.%s.%s',
            $widget->layout_type,
            $widget->style_variant
        );

        // Fallback to a generic view if specific one doesn't exist
        if (!view()->exists($viewName)) {
            $viewName = sprintf(
                'googlereview::frontend.widgets.%s.variant_1',
                $widget->layout_type
            );
        }

        return view($viewName, [
            'widget' => $widget,
            'reviews' => $reviews,
            'settings' => $widget->getSettings(),
        ]);
    }

    /**
     * Get widget data as JSON (for AJAX requests)
     */
    public function widgetJson($id)
    {
        $widget = GoogleReviewWidget::active()->findOrFail($id);
        $reviews = $widget->getReviews();

        return response()->json([
            'widget' => $widget,
            'reviews' => $reviews->map(function ($review) {
                return [
                    'id' => $review->id,
                    'reviewer_name' => $review->display_name,
                    'rating' => $review->rating,
                    'review_text' => $review->review_text,
                    'review_date' => $review->review_date->format('d.m.Y'),
                    'avatar_url' => $review->getAvatarUrl(),
                    'stars_html' => $review->getStarsHtml(),
                ];
            }),
            'settings' => $widget->getSettings(),
        ]);
    }
}

