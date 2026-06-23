<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // hash the password if it's not null
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('update_password')
                ->label('Parola Değiştirme')
                ->icon('heroicon-o-lock-closed')
                ->form([
                    TextInput::make('password')
                        ->minLength(8)
                        ->label('Parola')
                        ->placeholder('Parola')
                        ->required()
                        ->password()
                        ->autocomplete('new-password'),
                ])
                ->action(function ($data) {
                    $this->record->update([
                        'password' => bcrypt($data['password']),
                    ]);
                })
                ->requiresConfirmation(true),
            Actions\DeleteAction::make(),
        ];
    }
}
