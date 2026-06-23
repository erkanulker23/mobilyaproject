<?php

namespace Modules\Members\Filament\Resources\MemberResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Members\Filament\Resources\MemberResource;

class CreateMember extends CreateRecord
{
    protected static string $resource = MemberResource::class;
}
