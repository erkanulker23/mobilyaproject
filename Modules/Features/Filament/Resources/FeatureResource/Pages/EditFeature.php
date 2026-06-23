<?php

namespace Modules\Features\Filament\Resources\FeatureResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Features\Filament\Resources\FeatureResource;

class EditFeature extends EditRecord
{
    protected static string $resource = FeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
