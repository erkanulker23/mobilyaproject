<?php

namespace Modules\GoogleReview\Filament\Resources;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\GoogleReview\Entities\GoogleBusiness;
use Modules\GoogleReview\Filament\Resources\GoogleBusinessResource\Pages\CreateGoogleBusiness;
use Modules\GoogleReview\Filament\Resources\GoogleBusinessResource\Pages\EditGoogleBusiness;
use Modules\GoogleReview\Filament\Resources\GoogleBusinessResource\Pages\ListGoogleBusinesses;
use Modules\GoogleReview\Services\GooglePlacesService;
use Filament\Notifications\Notification;

class GoogleBusinessResource extends Resource
{
    protected static ?string $model = GoogleBusiness::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'İçerik Yönetimi';

    protected static ?int $navigationSort = 10;

    public static function getModelLabel(): string
    {
        return 'Google İşletmesi';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Google Yorumları';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('İşletme Bilgileri')
                    ->description('Google Maps linkini yapıştırın, bilgiler otomatik çıkarılacak')
                    ->schema([
                        Textarea::make('google_maps_url')
                            ->label('Google Maps URL')
                            ->placeholder('https://www.google.com/maps/place/Rota+Nakliyat...')
                            ->helperText('🔗 Google Maps → İşletmenizi bulun → Paylaş → Linki kopyala → Yapıştır')
                            ->required()
                            ->rows(3)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $set, $get) {
                                if (!empty($state) && empty($get('name'))) {
                                    $name = GoogleBusiness::extractNameFromUrl($state);
                                    $coords = GoogleBusiness::extractCoordinatesFromUrl($state);

                                    if ($name) {
                                        $set('name', $name);
                                    }

                                    if ($coords) {
                                        // Use Google Places API to get real Place ID
                                        $googlePlacesService = app(GooglePlacesService::class);
                                        $placeId = $googlePlacesService->extractPlaceIdFromUrl($state);

                                        if ($placeId) {
                                            $set('place_id', $placeId);
                                        } else {
                                            // Fallback: Generate a unique place_id from coordinates
                                            $placeId = md5($state);
                                            $set('place_id', $placeId);
                                        }

                                        // You can optionally set formatted address
                                        $address = "Koordinatlar: {$coords['lat']}, {$coords['lng']}";
                                        $set('formatted_address', $address);

                                        Notification::make()
                                            ->success()
                                            ->title('İşletme Bilgileri Çıkarıldı')
                                            ->body("✅ {$name}")
                                            ->send();
                                    }
                                }
                            }),

                        TextInput::make('name')
                            ->label('İşletme Adı')
                            ->required()
                            ->maxLength(255)
                            ->disabled(fn ($record) => $record !== null)
                            ->dehydrated()
                            ->helperText('URL\'den otomatik doldurulur'),

                        TextInput::make('place_id')
                            ->label('Google Place ID')
                            ->maxLength(255)
                            ->disabled(fn ($record) => $record !== null)
                            ->dehydrated()
                            ->helperText('Otomatik oluşturulur'),

                        TextInput::make('formatted_address')
                            ->label('Adres')
                            ->maxLength(500)
                            ->disabled(fn ($record) => $record !== null)
                            ->dehydrated()
                            ->helperText('Otomatik doldurulur'),
                    ]),

                Section::make('İstatistikler')
                    ->schema([
                        Placeholder::make('stats')
                            ->label('Bilgiler')
                            ->content(function ($record) {
                                if (!$record) {
                                    return 'İşletme kaydedildikten sonra istatistikler görünecek.';
                                }

                                $reviewCount = $record->reviews()->count();
                                $publishedCount = $record->publishedReviews()->count();
                                $avgRating = $record->reviews()->avg('rating') ?? 0;

                                return sprintf(
                                    "📊 Toplam Yorum: %d\n✅ Yayında: %d\n⭐ Ortalama Puan: %.1f / 5",
                                    $reviewCount,
                                    $publishedCount,
                                    $avgRating
                                );
                            }),

                    ])
                    ->visible(fn ($record) => $record !== null),

                Section::make('Ayarlar')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif mi?')
                            ->default(true)
                            ->helperText('Pasif işletmelerin yorumları frontend\'de gösterilmez'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('İşletme Adı')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Ortalama Puan')
                    ->formatStateUsing(fn ($state) => $state ? "⭐ {$state} / 5" : '-')
                    ->sortable(),
                Tables\Columns\TextColumn::make('reviews_count')
                    ->label('Sistem Yorumları')
                    ->counts('reviews')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_ratings_total')
                    ->label('Google Yorumları')
                    ->formatStateUsing(fn ($state) => $state ?: '-')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Durum'),
            ])
            ->actions([
                Tables\Actions\Action::make('fetch_reviews')
                    ->label('Yorumları Çek')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function (GoogleBusiness $record) {
                        try {
                            $service = new GooglePlacesService();
                            $apiKey = $service->getApiKey();

                            if (empty($apiKey)) {
                                Notification::make()
                                    ->warning()
                                    ->title('API Key Gerekli')
                                    ->body('Lütfen Settings → Genel Ayarlar → Google Yorumları API\'den API anahtarınızı ekleyin.')
                                    ->send();
                                return;
                            }

                            // Get or find place_id
                            if (empty($record->place_id) || strlen($record->place_id) < 20) {
                                $coords = GoogleBusiness::extractCoordinatesFromUrl($record->google_maps_url);
                                if ($coords) {
                                    $placeId = $service->getPlaceIdFromCoordinates($coords['lat'], $coords['lng']);
                                    if ($placeId) {
                                        $record->update(['place_id' => $placeId]);
                                    }
                                }

                                if (empty($record->place_id) || strlen($record->place_id) < 20) {
                                    $results = $service->searchPlace($record->name);
                                    if (!empty($results)) {
                                        $record->update(['place_id' => $results[0]['place_id']]);
                                    }
                                }
                            }

                            if (empty($record->place_id) || strlen($record->place_id) < 20) {
                                Notification::make()
                                    ->warning()
                                    ->title('İşletme Bulunamadı')
                                    ->body('Google\'da bu işletme bulunamadı.')
                                    ->send();
                                return;
                            }

                            // Fetch details and reviews
                            $details = $service->getPlaceDetails($record->place_id);

                            // Update business
                            $record->update([
                                'formatted_address' => $details['formatted_address'] ?? null,
                                'rating' => $details['rating'] ?? 0,
                                'user_ratings_total' => $details['user_ratings_total'] ?? 0,
                                'phone' => $details['formatted_phone_number'] ?? null,
                                'website' => $details['website'] ?? null,
                                'last_sync_at' => now(),
                                'api_data' => $details,
                            ]);

                            // Import reviews
                            $imported = 0;
                            if (isset($details['reviews'])) {
                                foreach ($details['reviews'] as $review) {
                                    $reviewData = $service->formatReviewData($review, $record->place_id);
                                    $reviewData['google_business_id'] = $record->id;

                                    $exists = \Modules\GoogleReview\Entities\GoogleReview::where('google_business_id', $record->id)
                                        ->where('reviewer_name', $reviewData['reviewer_name'])
                                        ->where('review_date', $reviewData['review_date'])
                                        ->first();

                                    if (!$exists) {
                                        \Modules\GoogleReview\Entities\GoogleReview::create($reviewData);
                                        $imported++;
                                    }
                                }
                            }

                            Notification::make()
                                ->success()
                                ->title('Yorumlar Çekildi')
                                ->body("✅ {$imported} yeni yorum eklendi. Toplam: " . $record->reviews()->count())
                                ->duration(5000)
                                ->send();

                        } catch (\Exception $e) {
                            Notification::make()
                                ->danger()
                                ->title('Hata')
                                ->body($e->getMessage())
                                ->send();
                        }
                    })
                    ->requiresConfirmation()
                    ->modalHeading(fn ($record) => "'{$record->name}' - Yorumları Çek")
                    ->modalDescription('Google\'dan yorumlar çekilecek. Devam edilsin mi?')
                    ->modalSubmitActionLabel('Evet, Çek'),
                Tables\Actions\EditAction::make()
                    ->label('Yorumları Yönet'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Henüz işletme eklenmemiş')
            ->emptyStateDescription('Yeni bir işletme eklemek için "Oluştur" butonuna tıklayın')
            ->emptyStateIcon('heroicon-o-building-office-2');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGoogleBusinesses::route('/'),
            'create' => CreateGoogleBusiness::route('/create'),
            'edit' => EditGoogleBusiness::route('/{record}/edit'),
        ];
    }
}

