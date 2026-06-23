<?php

namespace Modules\GoogleReview\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GoogleReview\Entities\GoogleReviewWidget;

class GoogleReviewWidgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GoogleReviewWidget::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $layoutTypes = ['grid', 'list', 'slider', 'masonry'];
        $layoutType = $this->faker->randomElement($layoutTypes);

        return [
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->slug(),
            'layout_type' => $layoutType,
            'style_variant' => 'variant_' . $this->faker->numberBetween(1, 3),
            'is_active' => true,
            'settings' => [
                'reviews_per_page' => 10,
                'show_rating' => true,
                'show_date' => true,
                'show_avatar' => true,
                'show_reviewer_name' => true,
                'min_rating' => 1,
                'columns' => 3,
                'autoplay' => true,
                'autoplay_speed' => 3000,
                'show_navigation' => true,
                'show_pagination' => true,
            ],
            'order' => $this->faker->numberBetween(0, 100),
        ];
    }
}

