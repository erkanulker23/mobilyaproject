<?php

namespace App\Filament\Widgets;

use App\Models\BlogCategory;
use Filament\Widgets\ChartWidget;

class PopularBlogCategories extends ChartWidget
{
    protected static ?string $heading = 'En Popüler Blog Kategorileri';

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $categories = BlogCategory::query()
            ->withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit(10)
            ->get();

        $labels = [];
        $data = [];
        $colors = [];

        foreach ($categories as $category) {
            $labels[] = $category->name;
            $data[] = $category->posts_count;
            $colors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }

        return [
            'datasets' => [
                [
                    'label' => 'Yazı Sayısı',
                    'data' => $data,
                    'backgroundColor' => $colors,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}

