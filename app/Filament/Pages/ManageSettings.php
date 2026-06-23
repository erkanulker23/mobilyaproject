<?php

namespace App\Filament\Pages;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Models\Page;
use App\Settings\GeneralSettings;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Filament\Forms\Set;
use Filament\Forms\Get;

class ManageSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = GeneralSettings::class;

    protected static ?string $navigationLabel = 'Genel Ayarlar';

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    protected function getFormSchema(): array
    {
        $menus = \Modules\Menu\Entities\Menu::pluck('name', 'id');

        return [
            TextInput::make('site_name')
,

            TinyEditor::make('footer_copyright')
                ->columnSpanFull()
                ->profile('full')
                ->label('Footer Metni')
                ->maxHeight(150)
,

            Section::make('address')
                ->heading('Adres Bilgileri')
                ->columns(2)
                ->description('Bu bilgiler sitenizin iletişim ve anasa sayfasında kullanılacaktır.')
                ->schema([
                    TextInput::make('address_country'),
                    TextInput::make('address_locality'),
                    TextInput::make('address_region'),
                    TextInput::make('post_office_box_number'),
                    TextInput::make('postal_code'),
                    TextInput::make('street_address'),
                    TextInput::make('address_google_maps_url')
                        ->label('Google Maps Linki')
                        ->helperText('Google Maps\'ten paylaşım linkini yapıştırın. Latitude ve longitude otomatik olarak ayarlanacaktır.')
                        ->reactive()
                        ->afterStateUpdated(function (Set $set, $state) {
                            if ($state) {
                                // Google Maps URL'sinden latitude, longitude ve yer adını çıkar
                                $coordinates = self::extractCoordinatesFromGoogleMapsUrl($state);
                                if ($coordinates) {
                                    $set('address_latitude', $coordinates['lat']);
                                    $set('address_longitude', $coordinates['lng']);
                                    if (isset($coordinates['place_name'])) {
                                        $set('address_place_name', $coordinates['place_name']);
                                    }
                                }
                            }
                        }),
                    TextInput::make('address_latitude')
                        ->label('Address Latitude')
                        ->readOnly()
                        ->helperText('Google Maps linkinden otomatik olarak doldurulur'),
                    TextInput::make('address_longitude')
                        ->label('Address Longitude')
                        ->readOnly()
                        ->helperText('Google Maps linkinden otomatik olarak doldurulur'),
                    TextInput::make('address_place_name')
                        ->label('Yer Adı')
                        ->readOnly()
                        ->helperText('Google Maps linkinden otomatik olarak doldurulur')
                        ->reactive(),
                    Actions::make([
                        Action::make('open_docs')
                            ->label('Dökümana Git')
                            ->url('https://schema.org/PostalAddress')
                            ->openUrlInNewTab(),
                    ]),
                ]),
            Section::make('contact')
                ->heading('İletişim Ayarları')
                ->columns(2)
                ->description('İletişim bilgileriniz.')
                ->schema([
                    TextInput::make('phone'),
                    TextInput::make('customer_service_phone'),
                    TextInput::make('whatsapp'),
                    TextInput::make('gsm'),
                    TextInput::make('email'),
                    TextInput::make('address'),
                    TextInput::make('google_maps_url')
                        ->label('Google Maps URL')
                        ->helperText('Google Maps\'ten paylaşım linkini yapıştırın. Latitude ve longitude otomatik olarak ayarlanacaktır.')
                        ->reactive()
                        ->afterStateUpdated(function (Set $set, $state) {
                            if ($state) {
                                // Google Maps URL'sinden latitude ve longitude çıkar
                                $coordinates = self::extractCoordinatesFromGoogleMapsUrl($state);
                                if ($coordinates) {
                                    $set('../../address_latitude', $coordinates['lat']);
                                    $set('../../address_longitude', $coordinates['lng']);
                                }
                            }
                        }),
                    TextInput::make('working_hours'),
                    Textarea::make('address_google_maps_embed')
                        ->label('Google Maps Embed Kodu')
                        ->helperText('Google Maps\'ten embed kodunu yapıştırın. Bu kod iletişim sayfasında harita olarak gösterilecektir.')
                        ->rows(4)
                        ->columnSpanFull(),
                ]),
            Section::make('seo')
                ->heading('SEO Ayarları')
                ->columns(1)
                ->description('Bu ayarlar sitenizin SEO ayarlarıdır.')
                ->schema([
                    TextInput::make('seo_title'),
                    Textarea::make('seo_description'),
                ]),
            Section::make('menus')
                ->heading('Menüler')
                ->columns(2)
                ->description('Menüler "Menüler" (/admin/menus) sayfasından oluşturulur; burada hangi menünün nerede kullanılacağını seçersiniz.')
                ->schema([
                    Select::make('header_menu')
                        ->label('Üst Menü (Header)')
                        ->options(fn () => \Modules\Menu\Entities\Menu::orderBy('name')->pluck('name', 'id')->toArray())
                        ->searchable()
                        ->helperText('Üst menü navigasyonu. Yeni menü için Menüler sayfasını kullanın.'),
                    Select::make('header_mobile_menu')
                        ->label('Üst Mobil Menü')
                        ->options(fn () => \Modules\Menu\Entities\Menu::orderBy('name')->pluck('name', 'id')->toArray())
                        ->searchable()
                        ->helperText('Boş bırakılırsa üst menü mobilde de kullanılır.'),
                    Select::make('footer_menu')
                        ->label('Alt Menü (Footer)')
                        ->options(fn () => \Modules\Menu\Entities\Menu::orderBy('name')->pluck('name', 'id')->toArray())
                        ->searchable()
                        ->helperText('Footer link sütunu bu menüden gelir.'),
                    Select::make('footer_mobile_menu')
                        ->label('Alt Mobil Menü')
                        ->options(fn () => \Modules\Menu\Entities\Menu::orderBy('name')->pluck('name', 'id')->toArray())
                        ->searchable(),
                ]),
            Section::make('analytics')
                ->heading('Google Analytics Raporları')
                ->columns(1)
                ->description('Bu ayarlar sitenizin Google Analytics ayarlarıdır.')
                ->schema([
                    TextInput::make('analytics_property_id')
                        ->label('Analytics Property ID'),
                    FileUpload::make('analytics_json_file_path')
                        ->label('Analytics JSON Dosyası')
                        ->helperText('Detaylı bilgi için: https://github.com/spatie/laravel-analytics#getting-credentials')
                        ->disk('local')
                        ->directory('analytics')
                        ->getUploadedFileNameForStorageUsing(function ($file): string {
                            return 'service-account-credentials.json';
                        })
                        ->acceptedFileTypes(['application/json']),
                ]),
            Section::make('logos')
                ->heading('Logo')
                ->columns(2)
                ->description('Logolarınızı buradan yükleyebilirsiniz.')
                ->schema([
                    FileUpload::make('header_logo')
                        ->directory('logos')
                        ->image(),
                    FileUpload::make('dark_header_logo')
                        ->directory('logos')
                        ->image(),
                    FileUpload::make('footer_logo')
                        ->directory('logos')
                        ->image(),
                    FileUpload::make('dark_footer_logo')
                        ->directory('logos')
                        ->image(),
                    FileUpload::make('favicon')
                        ->image(),
                    FileUpload::make('apple_touch_icon')
                        ->label('Apple Touch Icon')
                        ->helperText('iOS cihazlar için 180x180 piksel boyutunda PNG formatında icon yükleyin')
                        ->image()
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('1:1')
                        ->imageResizeTargetWidth('180')
                        ->imageResizeTargetHeight('180'),
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

                                ->url(),
                        ])
                        ->columns(2)
                        ->columnSpanFull(),
                ]),
            Section::make('robots_txt_section')
                ->heading('Robots.txt Ayarları')
                ->columns(1)
                ->description('Bu kısımdan robots.txt dosyanızı düzenleyebilirsiniz.')
                ->headerActions([
                    Action::make('set_to_default')
                        ->action(function(Set $set){
                           $set('robots_txt', "User-agent: *\nDisallow:\n");
                        }),
                ])
                ->schema([
                    Textarea::make('robots_txt'),
                ]),
            Section::make('google_api_section')
                ->heading('Google Yorumları API')
                ->columns(1)
                ->description('Google yorumlarını çekmek için API anahtarınızı girin.')
                ->schema([
                    TextInput::make('google_places_api_key')
                        ->label('Google Places API Key')
                        ->password()
                        ->revealable()
                        ->helperText('🔑 API anahtarınızı Google Cloud Console üzerinden alabilirsiniz. Bu key ile "Yorumları Çek" butonu çalışır.')
                        ->placeholder('AIzaSy...')
                        ->columnSpanFull(),
                    Actions::make([
                        Action::make('get_api_key')
                            ->label('🔑 API Key Nasıl Alınır?')
                            ->url(route('filament.admin.pages.dashboard') . '/../../../GOOGLE_API_KURULUM.md')
                            ->color('success')
                            ->icon('heroicon-o-book-open'),
                        Action::make('google_console')
                            ->label('📍 Google Cloud Console')
                            ->url('https://console.cloud.google.com/apis/credentials')
                            ->openUrlInNewTab()
                            ->color('info')
                            ->icon('heroicon-o-link'),
                        Action::make('enable_places_api')
                            ->label('⚡ Places API (New) Aktif Et')
                            ->url('https://console.cloud.google.com/apis/library/places-backend.googleapis.com')
                            ->openUrlInNewTab()
                            ->color('warning')
                            ->icon('heroicon-o-bolt'),
                    ])
                    ->columnSpanFull(),
                ]),

            Section::make('google_fonts_section')
                ->heading('Google Fonts')
                ->columns(1)
                ->description('Sitenizde kullanılacak Google Font\'u seçin.')
                ->schema([
                    Select::make('google_font_family')
                        ->label('Font Ailesi')
                        ->options([
                            'Inter' => 'Inter',
                            'Roboto' => 'Roboto',
                            'Open Sans' => 'Open Sans',
                            'Montserrat' => 'Montserrat',
                            'Poppins' => 'Poppins',
                            'Plus Jakarta Sans' => 'Plus Jakarta Sans',
                            'Lato' => 'Lato',
                            'Raleway' => 'Raleway',
                            'Nunito' => 'Nunito',
                            'Ubuntu' => 'Ubuntu',
                            'PT Sans' => 'PT Sans',
                            'Oswald' => 'Oswald',
                            'Playfair Display' => 'Playfair Display',
                            'Merriweather' => 'Merriweather',
                            'Source Sans Pro' => 'Source Sans Pro',
                            'Work Sans' => 'Work Sans',
                            'Rubik' => 'Rubik',
                            'Manrope' => 'Manrope',
                            'DM Sans' => 'DM Sans',
                            'Outfit' => 'Outfit',
                            'Quicksand' => 'Quicksand',
                            'Mulish' => 'Mulish',
                            'Barlow' => 'Barlow',
                            'Karla' => 'Karla',
                            'IBM Plex Sans' => 'IBM Plex Sans',
                            'Jost' => 'Jost',
                            'Space Grotesk' => 'Space Grotesk',
                            'Archivo' => 'Archivo',
                            'Lexend' => 'Lexend',
                            'Sora' => 'Sora',
                            'Red Hat Display' => 'Red Hat Display',
                            'Public Sans' => 'Public Sans',
                            'Figtree' => 'Figtree',
                            'Epilogue' => 'Epilogue',
                            'Cabin' => 'Cabin',
                            'Titillium Web' => 'Titillium Web',
                            'Heebo' => 'Heebo',
                            'Josefin Sans' => 'Josefin Sans',
                            'Noto Sans' => 'Noto Sans',
                            'Mukta' => 'Mukta',
                            'Libre Franklin' => 'Libre Franklin',
                            'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
                            'Abril Fatface' => 'Abril Fatface',
                            'Bebas Neue' => 'Bebas Neue',
                            'Anton' => 'Anton',
                            'Pacifico' => 'Pacifico',
                            'Dancing Script' => 'Dancing Script',
                            'Lobster' => 'Lobster',
                            'Shadows Into Light' => 'Shadows Into Light',
                        ])
                        ->searchable()

                        ->reactive()
                        ->afterStateUpdated(function (Set $set, $state) {
                            if ($state) {
                                $fontUrl = 'https://fonts.googleapis.com/css2?family=' . str_replace(' ', '+', $state) . ':wght@300;400;500;600;700;800&display=swap';
                                $set('google_font_url', $fontUrl);
                            }
                        })
                        ->helperText('Frontend temasında kullanılacak ana font ailesini seçin.'),
                    TextInput::make('google_font_url')
                        ->label('Google Font URL')
                        ->readOnly()
                        ->helperText('Font seçildiğinde otomatik olarak oluşturulur.'),
                ]),
        ];
    }

    /**
     * Google Maps URL'sinden latitude, longitude ve yer adını çıkarır
     *
     * @param string $url Google Maps URL
     * @return array|null ['lat' => float, 'lng' => float, 'place_name' => string] veya null
     */
    protected static function extractCoordinatesFromGoogleMapsUrl(string $url): ?array
    {
        // Boş URL kontrolü
        if (empty($url)) {
            return null;
        }

        $result = [
            'lat' => null,
            'lng' => null,
            'place_name' => null
        ];

        // Metod 1: /@latitude,longitude formatı
        // Örnek: /@40.9312963,29.132506,17z/
        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $matches)) {
            $result['lat'] = $matches[1];
            $result['lng'] = $matches[2];
        }

        // Metod 2: !3d!4d formatı (daha hassas koordinatlar)
        // Örnek: !3d40.9312963!4d29.1350809
        if (preg_match('/!3d(-?\d+\.\d+)!4d(-?\d+\.\d+)/', $url, $matches)) {
            $result['lat'] = $matches[1];
            $result['lng'] = $matches[2];
        }

        // Metod 3: Standart query parametreleri
        // Örnek: ?q=40.9312963,29.1350809
        if (preg_match('/[?&]q=(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $matches)) {
            $result['lat'] = $matches[1];
            $result['lng'] = $matches[2];
        }

        // Metod 4: ll parametresi
        // Örnek: &ll=40.9312963,29.1350809
        if (preg_match('/[?&]ll=(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $matches)) {
            $result['lat'] = $matches[1];
            $result['lng'] = $matches[2];
        }

        // Yer adını çıkarma - URL'den place name'i çıkar
        // Örnek: /place/Eczac%C4%B1o%C4%9Flu+Nakliyat/@40.9312963,29.132506,17z/
        if (preg_match('/\/place\/([^\/@]+)/', $url, $matches)) {
            $result['place_name'] = urldecode($matches[1]);
        }

        // Eğer koordinatlar bulunamadıysa null döndür
        if ($result['lat'] === null || $result['lng'] === null) {
            return null;
        }

        return $result;
    }
}
