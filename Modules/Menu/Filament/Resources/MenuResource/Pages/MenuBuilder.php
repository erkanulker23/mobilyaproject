<?php

namespace Modules\Menu\Filament\Resources\MenuResource\Pages;

use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Menu\Filament\Resources\MenuResource;

class MenuBuilder extends Page
{
    use InteractsWithRecord;

    protected static string $resource = MenuResource::class;

    protected static string $view = 'menu::filament.pages.menu-builder';

    public function getTitle(): string|Htmlable
    {
        return 'Menüyü Yapılandır';
    }

    public static function getNavigationLabel(): string
    {
        return 'Menüyü Yapılandır';
    }

    public function mount($record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->heading = 'Menüyü Yapılandır';
    }

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return false;
    }
}
