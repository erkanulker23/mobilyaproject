<?php

namespace Modules\Group\Filament\Resources\GroupResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Group\Filament\Resources\GroupResource;

class EditGroup extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = GroupResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
