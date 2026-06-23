<?php

namespace Modules\Slide\Filament\Resources\SlideResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Slide\Filament\Resources\SlideResource;

class CreateSlide extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = SlideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
