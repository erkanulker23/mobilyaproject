<?php

namespace Modules\Faq\Filament\Resources\FaqItemResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Faq\Filament\Resources\FaqItemResource;

class EditFaqItem extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = FaqItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
