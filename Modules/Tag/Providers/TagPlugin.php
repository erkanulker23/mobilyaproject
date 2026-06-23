<?php

namespace Modules\Tag\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\Tag\Filament\Resources\TagResource;

class TagPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'tag';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                TagResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
