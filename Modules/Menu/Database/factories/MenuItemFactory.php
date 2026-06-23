<?php

namespace Modules\Menu\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Menu\Entities\MenuItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'url' => fake()->url(),
            'target' => '_self',
            'icon' => 'fa fa-link',
            'link_class' => null,
            'wrapper_class' => null,
            'menu_id' => \Modules\Menu\Entities\Menu::factory(),
            'parameters' => [],
            'menuable_id' => null,
            'menuable_type' => null,
        ];
    }
}
