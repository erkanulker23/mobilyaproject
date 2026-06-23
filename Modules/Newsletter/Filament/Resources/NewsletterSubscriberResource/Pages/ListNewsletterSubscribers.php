<?php

namespace Modules\Newsletter\Filament\Resources\NewsletterSubscriberResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Newsletter\Filament\Resources\NewsletterSubscriberResource;

class ListNewsletterSubscribers extends ListRecords
{
    protected static string $resource = NewsletterSubscriberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
