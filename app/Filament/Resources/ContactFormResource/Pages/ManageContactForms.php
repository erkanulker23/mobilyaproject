<?php

namespace App\Filament\Resources\ContactFormResource\Pages;

use App\Filament\Resources\ContactFormSubmissionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageContactForms extends ManageRecords
{
    protected static string $resource = ContactFormSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
