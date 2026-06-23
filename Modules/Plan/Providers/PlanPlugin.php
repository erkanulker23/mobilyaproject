<?php

namespace Modules\Plan\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\Plan\Filament\Resources\PlanResource;

class PlanPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'plan';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                PlanResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
