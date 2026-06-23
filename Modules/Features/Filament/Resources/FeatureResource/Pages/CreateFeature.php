<?php

namespace Modules\Features\Filament\Resources\FeatureResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Features\Filament\Resources\FeatureResource;

class CreateFeature extends CreateRecord
{
    protected static string $resource = FeatureResource::class;
}
