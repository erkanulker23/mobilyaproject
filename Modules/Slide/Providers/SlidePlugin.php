<?php

namespace Modules\Slide\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\Slide\Filament\Resources\SlideResource;
use Modules\Slide\Filament\Resources\SliderResource;

class SlidePlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'slide';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                SliderResource::class,
                SlideResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
