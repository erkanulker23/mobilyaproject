<?php

namespace Modules\Faq\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FaqItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Faq\Entities\FaqItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->sentence(),
            'short_description' => fake()->sentence(),
        ];
    }
}
