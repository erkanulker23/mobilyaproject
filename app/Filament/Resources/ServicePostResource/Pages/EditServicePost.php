<?php

namespace App\Filament\Resources\ServicePostResource\Pages;

use App\Filament\Resources\ServicePostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServicePost extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = ServicePostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('show_blog_post')
                ->label('Yazıyı Görüntüle')
                ->icon('heroicon-o-arrow-right')
                ->url($this->record->url),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
