<?php

namespace App\Filament\Pages;

use App\Settings\TopbarSettings;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Guava\FilamentIconPicker\Forms\IconPicker;

class ManageTopbar extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static string $settings = TopbarSettings::class;

    protected static ?string $navigationLabel = 'Topbar Ayarları';

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('contact')
                ->heading('İletişim Ayarları')
                ->columns(2)
                ->description('İletişim bilgileriniz.')
                ->schema([
                    TextInput::make('phone'),
                    TextInput::make('gsm'),
                    TextInput::make('email'),
                    TextInput::make('address'),
                ]),
            Section::make('social_media_links')
                ->heading('Sosyal Medya Linkleri')
                ->columns(1)
                ->description('Sosyal medya linklerinizi buradan ekleyebilirsiniz.')
                ->schema([
                    Repeater::make('social_media_links')
                        ->schema([
                            Select::make('type')
                                ->label('Tip')
                                ->required()
                                ->options([
                                    'facebook' => 'Facebook',
                                    'twitter' => 'Twitter',
                                    'instagram' => 'Instagram',
                                    'youtube' => 'Youtube',
                                    'linkedin' => 'Linkedin',
                                ]),
                            TextInput::make('display_name')
                                ->label('Görünen İsim'),
                            TextInput::make('custom_icon')
                                ->label('İkon'),
                            IconPicker::make('icon')
                                ->columns([
                                    'default' => 1,
                                    'lg' => 3,
                                    '2xl' => 5,
                                ])
                                ->sets([
                                    'fontawesome-brands',
                                    'fontawesome-regular',
                                    'fontawesome-regular',
                                ])
                                ->label('İkon'),
                            TextInput::make('link')
                                ->label('Link')
                                ->required()
                                ->url(),
                        ])
                        ->columns(2)
                        ->columnSpanFull(),
                ]),
        ];
    }
}
