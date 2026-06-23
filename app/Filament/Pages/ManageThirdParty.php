<?php

namespace App\Filament\Pages;

use App\Settings\ThirdPartySettings;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;

class ManageThirdParty extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static string $settings = ThirdPartySettings::class;

    protected static ?string $navigationLabel = 'Üçüncü Parti Ayarları';

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('ai_api_section')
                ->heading('Yapay Zeka (AI) API Ayarları')
                ->description('Yapay zeka destekli içerik üretimi (blog/haber metni ve SEO önerileri) için OpenAI API anahtarınızı girin. Boş bırakılırsa AI özellikleri devre dışı kalır.')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    TextInput::make('openai_api_key')
                        ->label('OpenAI API Anahtarı')
                        ->placeholder('sk-...')
                        ->hint('API anahtarınızı buraya yapıştırın (şifreli saklanır).')
                        ->password()
                        ->revealable(),
                    Actions::make([
                        Action::make('go_to_openai_docs')
                            ->label('OpenAI API Anahtarı Oluştur')
                            ->icon('heroicon-o-arrow-top-right-on-square')
                            ->url('https://platform.openai.com/api-keys')
                            ->openUrlInNewTab(),
                    ]),
                ]),
        ];
    }
}
