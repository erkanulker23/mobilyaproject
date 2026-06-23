<?php

namespace Modules\GoogleReview\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\GoogleReview\Filament\Resources\GoogleBusinessResource;

class GoogleReviewPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'googlereview';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                GoogleBusinessResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}

