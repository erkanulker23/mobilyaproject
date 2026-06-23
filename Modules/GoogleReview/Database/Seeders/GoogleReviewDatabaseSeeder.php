<?php

namespace Modules\GoogleReview\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GoogleReview\Entities\GoogleReview;
use Modules\GoogleReview\Entities\GoogleReviewWidget;

class GoogleReviewDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create sample reviews
        GoogleReview::factory()->count(20)->create();
        GoogleReview::factory()->featured()->count(5)->create();

        // Create sample widgets
        GoogleReviewWidget::create([
            'name' => 'Ana Sayfa Yorumları',
            'slug' => 'ana-sayfa-yorumlari',
            'layout_type' => 'grid',
            'style_variant' => 'variant_1',
            'is_active' => true,
            'settings' => [
                'reviews_per_page' => 6,
                'show_rating' => true,
                'show_date' => true,
                'show_avatar' => true,
                'show_reviewer_name' => true,
                'min_rating' => 4,
                'columns' => 3,
            ],
            'order' => 1,
        ]);

        GoogleReviewWidget::create([
            'name' => 'Yorumlar Slider',
            'slug' => 'yorumlar-slider',
            'layout_type' => 'slider',
            'style_variant' => 'variant_1',
            'is_active' => true,
            'settings' => [
                'reviews_per_page' => 10,
                'show_rating' => true,
                'show_date' => true,
                'show_avatar' => true,
                'show_reviewer_name' => true,
                'min_rating' => 5,
                'autoplay' => true,
                'autoplay_speed' => 4000,
                'show_navigation' => true,
                'show_pagination' => true,
                'filter_by_featured' => true,
            ],
            'order' => 2,
        ]);
    }
}

