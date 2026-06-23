<?php

namespace Modules\Comment\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\Comment\Filament\Resources\CommentResource;

class CommentPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'comment';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                CommentResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
