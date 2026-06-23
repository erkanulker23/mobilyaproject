<?php

namespace Modules\References\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\References\Filament\Resources\ReferenceResource;

class ReferencePlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'references';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                ReferenceResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
