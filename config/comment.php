<?php

return [
    'name' => 'Comment',

    'model' => \Modules\Comment\Entities\Comment::class,

    'available_commentables' => [
        'product' => \Modules\Product\Entities\Product::class,
        'blog_post' => \App\Models\BlogPost::class,
    ],

    'available_commenteds' => [
        'user' => \App\Models\User::class,
    ],
];
