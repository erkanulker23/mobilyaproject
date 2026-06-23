<?php

namespace Modules\Members\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\Members\Filament\Resources\MemberResource;

class MemberPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'member';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                MemberResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
