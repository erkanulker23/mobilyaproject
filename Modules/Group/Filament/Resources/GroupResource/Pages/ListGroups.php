<?php

namespace Modules\Group\Filament\Resources\GroupResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Group\Filament\Resources\GroupResource;

class ListGroups extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = GroupResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
