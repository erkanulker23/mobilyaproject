<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Form Talebi')
                    ->columns(1)
                    ->schema([
                        TextInput::make('name')->label('Ad Soyad'),
                        TextInput::make('email')->label('E-posta')->email(),
                        TextInput::make('phone')->label('Telefon')->tel(),
                        TextInput::make('product')->label('İlgilenilen ürün'),
                        Textarea::make('message')->label('Mesaj')->rows(4)->columnSpanFull(),
                        Toggle::make('is_read')->label('Okundu olarak işaretle'),
                    ]),
            ]);
    }
}
