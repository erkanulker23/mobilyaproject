<?php

namespace Modules\Faq\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\Faq\Filament\Resources\FaqItemResource;
use Modules\Faq\Filament\Resources\FaqResource;

class FaqPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'faq';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                FaqResource::class,
                FaqItemResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
