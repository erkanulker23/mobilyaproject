<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Soru & Cevap')
                    ->columns(1)
                    ->schema([
                        TextInput::make('question_tr')->label('Soru (TR)')->required(),
                        TextInput::make('question_en')->label('Soru (EN)'),
                        Textarea::make('answer_tr')->label('Cevap (TR)')->rows(3)->required(),
                        Textarea::make('answer_en')->label('Cevap (EN)')->rows(3),
                        TextInput::make('sort')->label('Sıra')->numeric()->default(0),
                        Toggle::make('is_active')->label('Aktif')->default(true),
                    ]),
            ]);
    }
}
