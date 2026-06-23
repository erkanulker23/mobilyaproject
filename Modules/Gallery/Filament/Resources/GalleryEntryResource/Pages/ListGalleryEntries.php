<?php

namespace Modules\Gallery\Filament\Resources\GalleryEntryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Gallery\Filament\Resources\GalleryEntryResource;

class ListGalleryEntries extends ListRecords
{
    protected static string $resource = GalleryEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
