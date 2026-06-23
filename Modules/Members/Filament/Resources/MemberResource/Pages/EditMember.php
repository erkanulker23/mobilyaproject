<?php

namespace Modules\Members\Filament\Resources\MemberResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Members\Filament\Resources\MemberResource;

class EditMember extends EditRecord
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
