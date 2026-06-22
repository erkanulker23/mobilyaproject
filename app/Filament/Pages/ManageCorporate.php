<?php

namespace App\Filament\Pages;

use App\Filament\Support\SettingsPage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageCorporate extends SettingsPage
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?int $navigationSort = 48;

    protected static ?string $title = 'Kurumsal Sayfa';

    protected static ?string $navigationLabel = 'Kurumsal Sayfa';

    protected function settingsGroup(): string
    {
        return 'corporate';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kurumsal Görsel')
                    ->columns(1)
                    ->schema([
                        FileUpload::make('corp_hero')->label('Üst görsel')
                            ->image()->disk('site')->directory('uploads')->visibility('public'),
                    ]),
                Section::make('İstatistikler')
                    ->columns(1)
                    ->schema([
                        Repeater::make('corp_stats')
                            ->label('İstatistik kartları')
                            ->schema([
                                TextInput::make('value')->label('Değer')->placeholder('35+'),
                                TextInput::make('label_tr')->label('Etiket (TR)')->placeholder('Yıllık tecrübe'),
                                TextInput::make('label_en')->label('Etiket (EN)')->placeholder('Years of experience'),
                            ])
                            ->formatStateUsing(fn ($state) => is_array($state) ? $state : (json_decode((string) $state, true) ?: []))
                            ->columns(3)
                            ->defaultItems(0),
                    ]),
                Section::make('Değerlerimiz')
                    ->columns(1)
                    ->schema([
                        Repeater::make('corp_values')
                            ->label('Değer kartları')
                            ->schema([
                                TextInput::make('title_tr')->label('Başlık (TR)'),
                                TextInput::make('title_en')->label('Başlık (EN)'),
                                Textarea::make('desc_tr')->label('Açıklama (TR)')->rows(2),
                                Textarea::make('desc_en')->label('Açıklama (EN)')->rows(2),
                            ])
                            ->formatStateUsing(fn ($state) => is_array($state) ? $state : (json_decode((string) $state, true) ?: []))
                            ->columns(2)
                            ->defaultItems(0),
                    ]),
            ])
            ->statePath('data');
    }
}
