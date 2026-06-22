<?php

use Biostate\FilamentMenuBuilder\DTO\Menu;
use Biostate\FilamentMenuBuilder\DTO\MenuItem;

return [
    'models' => [
        'Ürün'     => 'App\\Models\\Product',
        'Kategori' => 'App\\Models\\Category',
        'Sayfa'    => 'App\\Models\\Page',
        'Haber'    => 'App\\Models\\News',
    ],
    'api_enabled' => true,
    'cache' => [
        'enabled' => true,
        'key' => 'filament-menu-builder',
        'ttl' => 60 * 60 * 24,
    ],
    'usable_parameters' => [
        // For example:
        // 'mega_menu',
        // 'mega_menu_columns',
    ],
    'exclude_route_names' => [
        '/^debugbar\./', // Exclude debugbar routes
        '/^filament\./',   // Exclude filament routes
        '/^livewire\./',   // Exclude livewire routes
    ],
    'exclude_routes' => [
        //
    ],
    'dto' => [
        'menu' => Menu::class,
        'menu_item' => MenuItem::class,
    ],
];
