<?php

namespace Modules\Members\Filament\Resources\MemberResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Members\Filament\Resources\MemberResource;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
