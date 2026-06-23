<?php

namespace Modules\Group\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\Group\Filament\Resources\GroupResource;

class GroupPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'group';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                GroupResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
