<?php

namespace Modules\Faq\Filament\Resources\FaqItemResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Faq\Filament\Resources\FaqItemResource;

class ListFaqItems extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = FaqItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
