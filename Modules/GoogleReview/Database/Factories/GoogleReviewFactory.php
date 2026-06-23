<?php

namespace Modules\GoogleReview\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GoogleReview\Entities\GoogleReview;

class GoogleReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GoogleReview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reviewer_name' => $this->faker->name(),
            'reviewer_email' => $this->faker->safeEmail(),
            'reviewer_avatar_url' => $this->faker->imageUrl(200, 200, 'people'),
            'rating' => $this->faker->numberBetween(3, 5),
            'review_text' => $this->faker->paragraph(3),
            'review_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'is_published' => true,
            'is_featured' => $this->faker->boolean(20),
            'is_anonymous' => false,
            'language' => 'tr',
            'order' => $this->faker->numberBetween(0, 100),
        ];
    }

    /**
     * Indicate that the review is featured.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_featured' => true,
            ];
        });
    }

    /**
     * Indicate that the review is anonymous.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function anonymous()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_anonymous' => true,
            ];
        });
    }
}

