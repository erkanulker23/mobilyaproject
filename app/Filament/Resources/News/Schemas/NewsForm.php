<?php

namespace App\Filament\Resources\News\Schemas;

use App\Filament\Support\Seo;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Haber / Blog')
                    ->columns(1)
                    ->schema([
                        TextInput::make('tr')
                            ->label('Başlık (TR)')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set, callable $get) => filled($get('slug')) ? null : $set('slug', Str::slug((string) $state))),
                        TextInput::make('en')->label('Başlık (EN)')->required(),
                        TextInput::make('slug')->label('Kısa ad (slug)')->required()->unique(ignoreRecord: true),
                        TextInput::make('date')->label('Tarih')->placeholder('12.06.2026'),
                        TextInput::make('cat_tr')->label('Kategori etiketi (TR)')->placeholder('Fuar'),
                        TextInput::make('cat_en')->label('Kategori etiketi (EN)')->placeholder('Fair'),
                        TextInput::make('sort')->label('Sıra')->numeric()->default(0)->columnSpanFull(),
                        Textarea::make('ex_tr')->label('Özet (TR)')->rows(2)->columnSpanFull(),
                        Textarea::make('ex_en')->label('Özet (EN)')->rows(2)->columnSpanFull(),
                    ]),
                Section::make('İçerik')
                    ->schema([
                        RichEditor::make('body_tr')->label('Metin (TR)')->columnSpanFull(),
                        RichEditor::make('body_en')->label('Metin (EN)')->columnSpanFull(),
                    ]),
                Seo::section(),
            ]);
    }
}
