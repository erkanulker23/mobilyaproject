<?php

namespace App\Filament\Pages;

use App\Filament\Support\SettingsPage;
use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Mail;

class ManageEmail extends SettingsPage
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?int $navigationSort = 52;

    protected static ?string $title = 'E-posta / SMTP Ayarları';

    protected static ?string $navigationLabel = 'E-posta / SMTP';

    protected function settingsGroup(): string
    {
        return 'mail';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('test')
                ->label('Test E-postası Gönder')
                ->icon(Heroicon::OutlinedPaperAirplane)
                ->color('gray')
                ->schema([
                    TextInput::make('to')->label('Alıcı adres')->email()->required()
                        ->default(fn () => Setting::where('key', 'mailRecipient')->value('value')),
                ])
                ->action(fn (array $data) => $this->sendTest($data['to'])),
        ];
    }

    protected function sendTest(string $to): void
    {
        $s = Setting::pluck('value', 'key');

        config([
            'mail.default'                  => 'smtp',
            'mail.mailers.smtp.host'        => $s['smtpHost'] ?? config('mail.mailers.smtp.host'),
            'mail.mailers.smtp.port'        => (int) ($s['smtpPort'] ?? 587),
            'mail.mailers.smtp.username'    => $s['smtpUser'] ?? null,
            'mail.mailers.smtp.password'    => $s['smtpPass'] ?? null,
            'mail.mailers.smtp.encryption'  => strtolower($s['smtpSecure'] ?? 'tls') ?: null,
            'mail.from.address'             => $s['mailSender'] ?? 'noreply@awamobilya.com',
            'mail.from.name'                => 'AWA Mobilya',
        ]);

        try {
            Mail::raw('AWA Mobilya — SMTP test e-postası. Bu mesajı aldıysanız e-posta ayarlarınız çalışıyor.', function ($m) use ($to) {
                $m->to($to)->subject('SMTP Test — AWA Mobilya');
            });

            Notification::make()->title('Test e-postası gönderildi: ' . $to)->success()->send();
        } catch (\Throwable $e) {
            Notification::make()->title('Gönderim başarısız')->body($e->getMessage())->danger()->persistent()->send();
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Bildirim Adresleri')
                    ->columns(1)
                    ->schema([
                        TextInput::make('mailRecipient')->label('Form alıcısı')->email()
                            ->helperText('İletişim formu gönderimleri bu adrese iletilir.'),
                        TextInput::make('mailSender')->label('Gönderen adres')->email(),
                    ]),
                Section::make('SMTP Sunucu')
                    ->columns(1)
                    ->schema([
                        TextInput::make('smtpHost')->label('Sunucu (host)')->placeholder('smtp.ornek.com'),
                        TextInput::make('smtpPort')->label('Port')->placeholder('587'),
                        TextInput::make('smtpUser')->label('Kullanıcı adı'),
                        TextInput::make('smtpPass')->label('Şifre')->password()->revealable(),
                        Select::make('smtpSecure')->label('Şifreleme')
                            ->options(['TLS' => 'TLS', 'SSL' => 'SSL', '' => 'Yok'])
                            ->default('TLS'),
                    ]),
            ])
            ->statePath('data');
    }
}
