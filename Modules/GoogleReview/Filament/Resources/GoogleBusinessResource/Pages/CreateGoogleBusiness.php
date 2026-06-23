<?php

namespace Modules\GoogleReview\Filament\Resources\GoogleBusinessResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\GoogleReview\Filament\Resources\GoogleBusinessResource;
use Modules\GoogleReview\Services\GooglePlacesService;
use Filament\Notifications\Notification;

class CreateGoogleBusiness extends CreateRecord
{
    protected static string $resource = GoogleBusinessResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record->id]);
    }

    protected function afterCreate(): void
    {
        Notification::make()
            ->success()
            ->title('İşletme Eklendi')
            ->body('Şimdi yorumları ekleyebilirsiniz. "Yeni Yorum Ekle" butonunu kullanın.')
            ->duration(5000)
            ->send();
    }
}

