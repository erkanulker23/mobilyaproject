<?php

namespace Modules\Features\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\Features\Filament\Resources\FeatureResource;

class FeaturesPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'features';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                FeatureResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
