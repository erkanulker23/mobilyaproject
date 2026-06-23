<?php

namespace Modules\Faq\Filament\Resources\FaqItemResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Faq\Filament\Resources\FaqItemResource;

class CreateFaqItem extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = FaqItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
