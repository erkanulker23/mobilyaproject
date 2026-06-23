<?php

namespace Modules\Slide\Filament\Resources\SlideResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Slide\Filament\Resources\SlideResource;

class EditSlide extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = SlideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
