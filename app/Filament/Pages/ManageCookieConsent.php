<?php

namespace App\Filament\Pages;

use App\Models\Page;
use App\Settings\GeneralSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;

class ManageCookieConsent extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static string $settings = GeneralSettings::class;

    protected static ?string $navigationLabel = 'Çerez Politikası';

    protected static ?string $title = 'Çerez Politikası (Cookie Consent)';

    protected static ?int $navigationSort = 90;

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Çerez Onayı Banner Ayarları')
                ->description('Sitenin altında görünen çerez (cookie) onay bandını buradan yönetin.')
                ->schema([
                    Toggle::make('show_cookie_consent_banner')
                        ->label('Çerez bandını göster (Aktif / Pasif)')
                        ->helperText('Kapalı olduğunda banner sitede hiç görünmez.')
                        ->inline(false),
                    Textarea::make('cookie_consent_banner_text')
                        ->label('Banner Metni')
                        ->rows(3)
                        ->placeholder('Bu web sitesi, deneyiminizi iyileştirmek için çerezleri kullanır...')
                        ->helperText('Ziyaretçilere gösterilecek çerez bilgilendirme metni.'),
                    Select::make('cookie_consent_page')
                        ->label('Çerez Politikası Sayfası (opsiyonel)')
                        ->options(fn () => Page::all()->mapWithKeys(fn ($p) => [$p->id => $p->title])->toArray())
                        ->searchable()
                        ->helperText('Banner içindeki "Detaylı bilgi" bağlantısının yönlendireceği sayfa.'),
                ]),
        ];
    }
}
