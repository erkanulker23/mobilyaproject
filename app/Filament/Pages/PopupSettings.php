<?php

namespace App\Filament\Pages;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;

class PopupSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';

    protected static string $settings = \App\Settings\PopupSettings::class;

    protected static ?string $navigationLabel = 'Popup Ayarları';

    protected function getHeaderActions(): array
    {
        $popupSettings = app(\App\Settings\PopupSettings::class);

        return [
            Action::make($popupSettings->is_active ? 'deactive' : 'active')
                ->label($popupSettings->is_active ? 'Popup\'ı Deaktif Et' : 'Popup\'ı Aktif Et')
                ->requiresConfirmation()
                ->action(function () use ($popupSettings) {
                    $popupSettings->is_active = ! $popupSettings->is_active;
                    $popupSettings->save();
                }),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->label('Başlık'),
            TextInput::make('cookie_days')
                ->numeric()
                ->default(7)
                ->step(1)
                ->label('Cookie Gün'),
            TinyEditor::make('content')
                ->fileAttachmentsDirectory('tinymce_uploads')
                ->minHeight('250')
                ->label('Açıklama')
                ->columnSpanFull(),
            TextInput::make('button_text')
                ->label('Buton Metni'),
            TextInput::make('button_url')
                ->label('Buton URL')
                ->url(),
            TextInput::make('button_class')
                ->label('Buton Class'),
        ];
    }
}
