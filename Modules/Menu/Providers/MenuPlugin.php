<?php

namespace Modules\Menu\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\Menu\Filament\Resources\MenuItemResource;
use Modules\Menu\Filament\Resources\MenuResource;

class MenuPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'menu';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                MenuResource::class,
                MenuItemResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
