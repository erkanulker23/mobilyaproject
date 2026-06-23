<?php

namespace Modules\Gallery\Providers;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Modules\Gallery\Filament\Resources\GalleryCategoryResource;
use Modules\Gallery\Filament\Resources\GalleryEntryResource;

class GalleryPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'gallery';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                GalleryCategoryResource::class,
                GalleryEntryResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
