<?php

return [
    'name' => 'Slide',
    'models' => [
        'slide' => \Modules\Slide\Entities\Slide::class,
        'slider' => \Modules\Slide\Entities\Slider::class,
    ],
    'target_types' => [
        'Page' => \App\Models\Page::class,
        'Blog Post' => \App\Models\BlogPost::class,
        'Blog Category' => \App\Models\BlogCategory::class,
        'Service Post' => \App\Models\ServicePost::class,
        'Service Category' => \App\Models\ServiceCategory::class,
    ],
];
