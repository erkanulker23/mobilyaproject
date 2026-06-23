<?php

namespace Modules\Gallery\Filament\Resources\GalleryEntryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Gallery\Filament\Resources\GalleryEntryResource;

class EditGalleryEntry extends EditRecord
{
    protected static string $resource = GalleryEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
