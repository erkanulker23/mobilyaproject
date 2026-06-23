<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // hash the password if it's not null
        //if (isset($data['password'])) {
        //    $data['password'] = bcrypt($data['password']);
        //}

        $data['password'] = bcrypt('123456789');

        return $data;
    }
}
