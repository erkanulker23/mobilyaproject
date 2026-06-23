<?php

namespace Modules\Slide\Filament\Resources\SlideResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Slide\Filament\Resources\SlideResource;

class ListSlides extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = SlideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
