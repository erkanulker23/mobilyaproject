<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Filament\Support\Seo;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Sayfa')
                    ->columns(1)
                    ->schema([
                        TextInput::make('key')
                            ->label('Anahtar')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('mesafeli, kvkk, gizlilik gibi sabit kimlik.'),
                        TextInput::make('t_tr')->label('Başlık (TR)'),
                        TextInput::make('t_en')->label('Başlık (EN)'),
                    ]),
                Section::make('İçerik')
                    ->schema([
                        RichEditor::make('b_tr')->label('Metin (TR)')->columnSpanFull(),
                        RichEditor::make('b_en')->label('Metin (EN)')->columnSpanFull(),
                    ]),
                Seo::section(),
            ]);
    }
}
