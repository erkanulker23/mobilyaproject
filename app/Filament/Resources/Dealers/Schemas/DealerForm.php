<?php

namespace App\Filament\Resources\Dealers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DealerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('city')
                    ->label('Şehir / Bayi adı')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set, callable $get) => filled($get('slug')) ? null : $set('slug', Str::slug((string) $state))),
                TextInput::make('slug')->label('Kısa ad (slug)')->required()->unique(ignoreRecord: true),
                TextInput::make('addr')->label('Adres')->columnSpanFull(),
                TextInput::make('tel')->label('Telefon')->tel(),
                TextInput::make('sort')->label('Sıra')->numeric()->default(0),
            ]);
    }
}
