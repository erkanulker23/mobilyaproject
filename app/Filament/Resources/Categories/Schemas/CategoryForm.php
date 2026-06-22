<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Filament\Support\Seo;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kategori Bilgileri')
                    ->columns(1)
                    ->schema([
                        TextInput::make('tr')
                            ->label('Ad (TR)')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set, callable $get) => filled($get('slug')) ? null : $set('slug', Str::slug((string) $state))),
                        TextInput::make('en')
                            ->label('Ad (EN)')
                            ->required(),
                        TextInput::make('slug')
                            ->label('Kısa ad (slug)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('Frontend eşleşmesi için benzersiz kimlik.'),
                        TextInput::make('sort')
                            ->label('Sıra')
                            ->numeric()
                            ->default(0),
                        FileUpload::make('img')
                            ->label('Görsel')
                            ->image()
                            ->disk('site')
                            ->directory('uploads')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),
                        Textarea::make('d_tr')->label('Açıklama (TR)')->rows(3)->columnSpanFull(),
                        Textarea::make('d_en')->label('Açıklama (EN)')->rows(3)->columnSpanFull(),
                    ]),
                Seo::section(),
            ]);
    }
}
