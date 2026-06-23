<?php

namespace App\Filament\Pages;

use App\Notifications\Admin\TestNotification;
use App\Settings\EmailSettings;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Facades\Notification;

class ManageEmail extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';

    protected static string $settings = EmailSettings::class;

    protected static ?string $navigationLabel = 'Email Ayarları';

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('username')->required(),
            TextInput::make('password')->required(),
            TextInput::make('host')->required(),
            TextInput::make('port')->required(),
            TextInput::make('from_address')->required(),
            TextInput::make('from_name')->required(),
            Checkbox::make('encryption'),
            Section::make('test_email')
                ->heading('Test Email')
                ->description('Lütfen ayarlarınızı kaydettikten sonra test emaili gönderiniz.')
                ->schema([
                    TextInput::make('test_email'),
                    Actions::make([
                        Action::make('test_email_action')
                            ->requiresConfirmation()
                            ->icon('heroicon-o-envelope')
                            ->label('Test Email Gönder')
                            ->action(function ($get) {
                                if ($get('test_email') && filter_var($get('test_email'), FILTER_VALIDATE_EMAIL)) {
                                    try {
                                        Notification::route('mail', $get('test_email'))
                                            ->notify(new TestNotification());
                                        \Filament\Notifications\Notification::make()
                                            ->success()
                                            ->title('Test emaili gönderildi.')
                                            ->body('Lütfen emailinizi kontrol ediniz.')
                                            ->persistent()
                                            ->send();
                                    } catch (\Exception $e) {
                                        \Filament\Notifications\Notification::make()
                                            ->danger()
                                            ->title('Test emaili gönderilemedi.')
                                            ->body('Lütfen SMTP ayarlarınızı kontrol ediniz. Hata mesajı:'.$e->getMessage())
                                            ->persistent()
                                            ->send();
                                    }
                                } else {
                                    \Filament\Notifications\Notification::make()
                                        ->danger()
                                        ->title('Test emaili gönderilemedi.')
                                        ->body('Lütfen geçerli bir email adresi giriniz.')
                                        ->persistent()
                                        ->send();
                                }
                            }),
                    ]),
                ]),
        ];
    }
}
