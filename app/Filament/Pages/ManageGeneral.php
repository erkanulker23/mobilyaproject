<?php

namespace App\Filament\Pages;

use App\Filament\Support\SettingsPage;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageGeneral extends SettingsPage
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?int $navigationSort = 50;

    protected static ?string $title = 'Genel Ayarlar';

    protected static ?string $navigationLabel = 'Genel Ayarlar';

    protected function settingsGroup(): string
    {
        return 'general';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Diller')
                    ->description('Frontend\'de yalnızca seçili diller gösterilir.')
                    ->columns(1)
                    ->schema([
                        CheckboxList::make('locales')
                            ->label('Aktif diller')
                            ->options(['tr' => 'Türkçe', 'en' => 'İngilizce'])
                            ->default(['tr', 'en'])
                            ->columns(2)
                            ->formatStateUsing(fn ($state) => is_array($state) ? $state : array_filter(explode(',', (string) $state)))
                            ->dehydrateStateUsing(fn ($state) => implode(',', (array) ($state ?: ['tr']))),
                    ]),
                Section::make('Marka & Logo')
                    ->columns(1)
                    ->schema([
                        TextInput::make('brandTr')->label('Marka adı')->placeholder('AWA'),
                        TextInput::make('brandSub')->label('Marka alt yazısı')->placeholder('MOBİLYA'),
                        FileUpload::make('logo')->label('Açık tema logosu (koyu zemin için)')->image()->disk('site')->directory('uploads')->visibility('public'),
                        FileUpload::make('logo_dark')->label('Koyu tema logosu (açık zemin için)')->image()->disk('site')->directory('uploads')->visibility('public'),
                        FileUpload::make('favicon')->label('Favicon')->image()->disk('site')->directory('uploads')->visibility('public'),
                    ]),
                Section::make('İletişim')
                    ->columns(1)
                    ->schema([
                        TextInput::make('phone')->label('Telefon')->tel(),
                        TextInput::make('email')->label('E-posta')->email(),
                        TextInput::make('addressTr')->label('Adres (TR)'),
                        TextInput::make('addressEn')->label('Adres (EN)'),
                        TextInput::make('hoursTr')->label('Çalışma saatleri (TR)'),
                        TextInput::make('hoursEn')->label('Çalışma saatleri (EN)'),
                    ]),
                Section::make('Hakkımızda')
                    ->columns(1)
                    ->schema([
                        Textarea::make('aboutTr')->label('Hakkımızda (TR)')->rows(4),
                        Textarea::make('aboutEn')->label('Hakkımızda (EN)')->rows(4),
                    ]),
                Section::make('İzleme & Analytics')
                    ->columns(1)
                    ->schema([
                        TextInput::make('ga_id')->label('Google Analytics ölçüm kimliği')
                            ->placeholder('G-XXXXXXXXXX')
                            ->helperText('Girilirse tüm sayfalara Google Analytics kodu eklenir.'),
                    ]),
                Section::make('Özel Kod (Style / Script)')
                    ->description('Tüm sayfalara eklenir. Ham HTML/script/style yazabilirsiniz.')
                    ->columns(1)
                    ->collapsed()
                    ->schema([
                        Textarea::make('custom_css')->label('Özel CSS')->rows(5)->placeholder(':root { } .site-header { }'),
                        Textarea::make('code_head')->label('Header kodu (&lt;head&gt; içine)')->rows(5)
                            ->helperText('Meta etiketleri, doğrulama kodları, <script>/<style> vb.'),
                        Textarea::make('code_body')->label('Body başı kodu (&lt;body&gt; hemen sonrası)')->rows(5)
                            ->helperText('Google Tag Manager noscript, chat widget vb.'),
                        Textarea::make('code_footer')->label('Footer kodu (&lt;/body&gt; öncesi)')->rows(5)
                            ->helperText('Analitik, pixel, özel JS vb.'),
                    ]),
            ])
            ->statePath('data');
    }
}
