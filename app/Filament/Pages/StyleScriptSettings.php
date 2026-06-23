<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Grid;
use Filament\Pages\SettingsPage;
use Riodwanto\FilamentAceEditor\AceEditor;

class StyleScriptSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-code-bracket';

    protected static string $settings = \App\Settings\StyleScriptSettings::class;

    protected static ?string $navigationLabel = 'Stil ve Script Ayarları';

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make()
                ->columns(1)
                ->schema([
                    AceEditor::make('header_codes')
                        ->helperText('Buraya head tagleri arasına gelecek kodları yazabilirsiniz.')
                        ->mode('html')
                        ->theme('github')
                        ->darkTheme('dracula'),
                    AceEditor::make('scripts')
                        ->helperText('Buraya body tagi bitmeden önce eklemeniz gereken script kodlarını yazabilirsiniz.')
                        ->mode('html')
                        ->theme('github')
                        ->darkTheme('dracula'),
                    AceEditor::make('styles')
                        ->helperText('Buraya ezmek istediğiniz stil kodlarınızı girebilirsiniz..')
                        ->mode('css')
                        ->theme('github')
                        ->darkTheme('dracula'),
                ]),
        ];
    }
}
