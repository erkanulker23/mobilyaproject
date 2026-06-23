<?php

namespace Modules\GoogleReview\Filament\Resources\GoogleBusinessResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Modules\GoogleReview\Filament\Resources\GoogleBusinessResource;
use Modules\GoogleReview\Services\GooglePlacesService;
use Modules\GoogleReview\Entities\GoogleBusiness;
use Modules\GoogleReview\Entities\GoogleReview;

class ListGoogleBusinesses extends ListRecords
{
    protected static string $resource = GoogleBusinessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Yeni İşletme Ekle'),
        ];
    }
}

