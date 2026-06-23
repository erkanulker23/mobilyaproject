<?php

namespace Database\Seeders;

use App\Settings\HomepageSettings;
use Illuminate\Database\Seeder;
use Modules\Category\Entities\Category;
use Modules\Group\Entities\Group;
use Modules\Menu\Entities\Menu;
use Modules\Product\Entities\Product;
use Modules\Slide\Entities\Slider;

class DefaultThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Yemek Odaları',
                'code' => 'YMK-ODLR',
                'children' => [
                    [
                        'name' => 'Yemek Odası Takımları',
                        'code' => 'YMK-ODLR-TKM',
                        'children' => [
                            [
                                'name' => 'Modern Yemek Odaları',
                                'code' => 'MRDN-YMK-ODLR',
                            ],
                            [
                                'name' => 'Ekonomik Yemek Odaları',
                                'code' => 'EK-YMK-ODLR',
                            ],
                            [
                                'name' => 'Country Yemek Odaları',
                                'code' => 'CN-YMK-ODLR',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Koltuk Takımları',
                'code' => 'KLTK-TKMLR',
                'children' => [
                    [
                        'name' => 'Modern Koltuk Takımları',
                        'code' => 'MRDN-KLTK-TKMLR',
                    ],
                    [
                        'name' => 'Ekonomik Koltuk Takımları',
                        'code' => 'EK-KLTK-TKMLR',
                    ],
                    [
                        'name' => 'Country Koltuk Takımları',
                        'code' => 'CN-KLTK-TKMLR',
                    ],
                ],
            ],
            [
                'name' => 'Yatak Odası Takımları',
                'code' => 'YTK-ODS-TKMLR',
            ],
        ];

        $this->generateSliders();

        $this->generateTestProducts();

        $this->generateCategories($categories);

        $this->generateHeaderMenu();

        $this->generateHomePageCategoriesAndProducts();

        $this->generateHomepageContent();

        $this->generateHomepageCategories();
    }

    public function generateSliders()
    {
        $slider = Slider::create([
            'title' => 'home',
        ]);

        $slide1 = $slider->slides()->create([
            'title' => fake()->words(3, true),
            'subtitle' => fake()->words(6, true),
            'cta_text' => 'Show',
            'link_url' => '#',
            'order_column' => '1',
            'publish_at' => now()->subDay(1),
        ]);

        $slide1
            ->addMedia(base_path('resources/img/slide-1.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('image');

        $slide2 = $slider->slides()->create([
            'title' => fake()->words(3, true),
            'subtitle' => fake()->words(5, true),
            'cta_text' => 'Show',
            'link_url' => '#',
            'order_column' => '2',
            'publish_at' => now()->subDay(1),
        ]);

        $slide2
            ->addMedia(base_path('resources/img/slide-2.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('image');

        $slide3 = $slider->slides()->create([
            'title' => fake()->words(2, true),
            'subtitle' => fake()->words(4, true),
            'cta_text' => 'Show',
            'link_url' => '#',
            'order_column' => '3',
            'publish_at' => now()->subDay(1),
        ]);

        $slide3
            ->addMedia(base_path('resources/img/slide-3.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('image');
    }

    public function generateTestProducts()
    {
        $productInfo = [
            'name' => 'Oslo Ekru Yatak Odası Takımı',
            'sale_price' => 36590,
            'price' => 48210,
        ];

        $product = Product::factory()->create($productInfo);

        for ($imageIndex = 1; $imageIndex < 8; $imageIndex++) {
            $product
                ->addMedia(base_path("resources/img/oslo-{$imageIndex}.jpg"))
                ->preservingOriginal()
                ->toMediaCollection('images');
        }

        $childProductInfos = [
            [
                'product' => [
                    'name' => 'Oslo Ekru 5 Kapılı Dolap',
                    'sale_price' => 19040,
                    'price' => 21330,
                ],
                'pivot' => [
                    'order_column' => 1,
                    'quantity' => 1,
                    'is_active' => true,
                ],
            ],
            [
                'product' => [
                    'name' => 'Oslo Ekru Şifonyer+Ayna',
                    'sale_price' => 8760,
                    'price' => 9810,
                ],
                'pivot' => [
                    'order_column' => 2,
                    'quantity' => 1,
                    'is_active' => true,
                ],
            ],
            [
                'product' => [
                    'name' => 'Oslo Ekru Komodin',
                    'sale_price' => 2560,
                    'price' => 2870,
                ],
                'pivot' => [
                    'order_column' => 3,
                    'quantity' => 2,
                    'is_active' => true,
                ],
            ],
            [
                'product' => [
                    'name' => 'Oslo Karyola (Bazalı)',
                    'sale_price' => 10120,
                    'price' => 11330,
                ],
                'pivot' => [
                    'order_column' => 4,
                    'quantity' => 1,
                    'is_active' => true,
                ],
            ],
        ];

        foreach ($childProductInfos as $key => $childProductInfo) {
            $childProduct = Product::factory()->create($childProductInfo['product']);

            $product->child_products()->attach($childProduct, $childProductInfo['pivot']);

            $key += 1;
            $childProduct
                ->addMedia(base_path("resources/img/oslo-alt-{$key}.jpg"))
                ->preservingOriginal()
                ->toMediaCollection('images');
        }
    }

    public function generateCategories($categories, $parentId = null)
    {
        foreach ($categories as $category) {
            $ct_model = Category::create([
                'name' => $category['name'],
                'code' => $category['code'],
                'parent_id' => $parentId,
            ]);

            if (array_key_exists('children', $category)) {
                $this->generateCategories($category['children'], $ct_model->id);
            }
        }
    }

    public function generateHomePageCategoriesAndProducts()
    {
        $homepageCategorySliderGroup = Group::create([
            'title' => 'Homepage Category Features',
        ]);

        Category::factory(3)->create()->each(function ($category) use (&$homepageCategorySliderGroup) {
            $homepageCategorySliderGroup->categories()->attach($category);

            Product::factory(10)->create()->each(function ($product) use ($category) {
                $product
                    ->addMedia(base_path('resources/img/dummy-product-image.jpg'))
                    ->preservingOriginal()
                    ->toMediaCollection('images');

                $category->products()->attach($product);
            });
        });

        $homepageMostSellerSliderGroup = Group::create([
            'title' => 'Most Sellers',
        ]);

        Product::factory(10)->create()->each(function ($product) use (&$homepageMostSellerSliderGroup) {
            $product
                ->addMedia(base_path('resources/img/dummy-product-image.jpg'))
                ->preservingOriginal()
                ->toMediaCollection('images');

            $homepageMostSellerSliderGroup->products()->attach($product);
        });
    }

    public function generateHomepageContent()
    {
        $homepage_content = [
            [
                'data' => [
                    'slider_name' => 'home',
                ],
                'type' => 'hero_slider',
            ],
            [
                'data' => [
                    'limit' => null,
                    'group_slug' => 'homepage-categories',
                    'section_title' => 'Categories',
                    'section_subtitle' => null,
                ],
                'type' => 'category_group_slider',
            ],
            [
                'data' => [
                    'limit' => null,
                    'group_slug' => 'homepage-category-features',
                    'section_title' => 'Featured Categories',
                    'section_subtitle' => 'Featured Categories',
                ],
                'type' => 'category_group_product_slider',
            ],
            [
                'data' => [
                    'limit' => null,
                    'cta_link' => null,
                    'cta_text' => null,
                    'group_slug' => 'most-sellers',
                    'section_title' => 'Best of the Bests',
                    'section_subtitle' => 'Most Sellers',
                ],
                'type' => 'product_group_slider',
            ],
        ];

        $homepage_settings = new HomepageSettings();
        $homepage_settings->content = $homepage_content;
        $homepage_settings->save();
    }

    public function generateHeaderMenu()
    {
        $menu = Menu::create([
            'name' => 'header',
        ]);

        $menu->items()->create([
            'name' => 'Home',
            'url' => '/',
        ]);

        $this->generateCategoryMenuItems($menu);

        $menu->items()->create([
            'name' => 'Products',
            'url' => '/products',
        ]);

        $menu->items()->create([
            'name' => 'About',
            'url' => '/about',
        ]);

        $menu->items()->create([
            'name' => 'Contact',
            'url' => '/contact',
        ]);
    }

    public function generateCategoryMenuItems($menu, $parent = null)
    {
        if ($parent) {
            $categories = Category::where('parent_id', $parent)->get();
        } else {
            $categories = Category::whereNull('parent_id')->get();
        }

        foreach ($categories as $category) {
            $item = $menu->items()->create([
                'name' => $category->name,
                'parent_id' => $parent,
                'menuable_id' => $category->id,
                'menuable_type' => Category::class,
            ]);

            $this->generateCategoryMenuItems($menu, $item->id);
        }
    }

    private function generateHomepageCategories()
    {
        $homepageCategoriesSliderGroup = Group::create([
            'title' => 'Homepage Categories',
        ]);

        Category::factory(10)->create()->each(function ($category) use (&$homepageCategoriesSliderGroup) {
            $homepageCategoriesSliderGroup->categories()->attach($category);
        });
    }
}
