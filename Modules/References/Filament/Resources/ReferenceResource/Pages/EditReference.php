<?php

namespace Modules\References\Filament\Resources\ReferenceResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReference extends EditRecord
{
    protected static string $resource = \Modules\References\Filament\Resources\ReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
