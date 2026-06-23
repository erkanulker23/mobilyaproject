<?php

namespace Modules\Group\Filament\Resources\GroupResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Group\Filament\Resources\GroupResource;

class CreateGroup extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = GroupResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
