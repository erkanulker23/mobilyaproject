<?php

namespace Modules\Newsletter\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\Newsletter\Filament\Resources\NewsletterSubscriberResource;

class NewsletterPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'newsletter';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                NewsletterSubscriberResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
