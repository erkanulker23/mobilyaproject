<?php

namespace Modules\GoogleReview\Filament\Resources\GoogleBusinessResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\GoogleReview\Entities\GoogleReview;
use Modules\GoogleReview\Filament\Resources\GoogleBusinessResource;

class EditGoogleBusiness extends EditRecord implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = GoogleBusinessResource::class;

    protected static string $view = 'googlereview::filament.pages.edit-google-business';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('fetch_reviews')
                ->label('Google\'dan Yorumları Çek')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    try {
                        $service = new \Modules\GoogleReview\Services\GooglePlacesService();
                        $apiKey = $service->getApiKey();

                        if (empty($apiKey)) {
                            Notification::make()
                                ->warning()
                                ->title('API Key Gerekli')
                                ->body('Lütfen Settings → Genel Ayarlar → Google API\'den API anahtarınızı ekleyin.')
                                ->send();
                            return;
                        }

                        $business = $this->record;

                        // Get or find place_id
                        if (empty($business->place_id) || strlen($business->place_id) < 20) {
                            $coords = \Modules\GoogleReview\Entities\GoogleBusiness::extractCoordinatesFromUrl($business->google_maps_url);
                            if ($coords) {
                                $placeId = $service->getPlaceIdFromCoordinates($coords['lat'], $coords['lng']);
                                if ($placeId) {
                                    $business->update(['place_id' => $placeId]);
                                }
                            }

                            if (empty($business->place_id) || strlen($business->place_id) < 20) {
                                $results = $service->searchPlace($business->name);
                                if (!empty($results)) {
                                    $business->update(['place_id' => $results[0]['place_id']]);
                                }
                            }
                        }

                        if (empty($business->place_id) || strlen($business->place_id) < 20) {
                            Notification::make()
                                ->warning()
                                ->title('İşletme Bulunamadı')
                                ->body('Google\'da bu işletme bulunamadı.')
                                ->send();
                            return;
                        }

                        // Fetch details and reviews
                        $details = $service->getPlaceDetails($business->place_id);

                        // Update business
                        $business->update([
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
                                $reviewData = $service->formatReviewData($review, $business->place_id);
                                $reviewData['google_business_id'] = $business->id;

                                $exists = GoogleReview::where('google_business_id', $business->id)
                                    ->where('reviewer_name', $reviewData['reviewer_name'])
                                    ->where('review_date', $reviewData['review_date'])
                                    ->first();

                                if (!$exists) {
                                    GoogleReview::create($reviewData);
                                    $imported++;
                                }
                            }
                        }

                        Notification::make()
                            ->success()
                            ->title('Yorumlar Çekildi')
                            ->body("✅ {$imported} yeni yorum eklendi. Toplam: " . $business->reviews()->count())
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
                ->modalHeading('Yorumları Çek')
->modalDescription('Google\'dan yorumlar çekilecek. Devam edilsin mi?')
                ->modalSubmitActionLabel('Evet, Çek'),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(GoogleReview::query()->where('google_business_id', $this->record->id)->ordered())
            ->columns([
                Tables\Columns\TextColumn::make('reviewer_name')
                    ->label('Yorumcu')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Puan')
                    ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('review_text')
                    ->label('Yorum')
                    ->limit(100)
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('review_date')
                    ->label('Tarih')
                    ->dateTime('d.m.Y')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Yayında')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rating')
                    ->label('Puan')
                    ->options([
                        5 => '⭐⭐⭐⭐⭐ 5 Yıldız',
                        4 => '⭐⭐⭐⭐ 4 Yıldız',
                        3 => '⭐⭐⭐ 3 Yıldız',
                        2 => '⭐⭐ 2 Yıldız',
                        1 => '⭐ 1 Yıldız',
                    ]),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Yayın Durumu'),
            ])
            ->actions([
                Tables\Actions\Action::make('toggle_publish')
                    ->label(fn (GoogleReview $record): string => $record->is_published ? 'Yayından Kaldır' : 'Yayınla')
                    ->icon(fn (GoogleReview $record): string => $record->is_published ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (GoogleReview $record): string => $record->is_published ? 'warning' : 'success')
                    ->action(function (GoogleReview $record) {
                        $record->is_published = !$record->is_published;
                        $record->save();

                        Notification::make()
                            ->success()
                            ->title($record->is_published ? 'Yayınlandı' : 'Yayından Kaldırıldı')
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make()
                    ->label('Sil'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('publish')
                        ->label('Yayınla')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->update(['is_published' => true]);
                            Notification::make()
                                ->success()
                                ->title('Yorumlar yayınlandı')
                                ->send();
                        }),
                    Tables\Actions\BulkAction::make('unpublish')
                        ->label('Yayından Kaldır')
                        ->icon('heroicon-o-eye-slash')
                        ->color('warning')
                        ->action(function ($records) {
                            $records->each->update(['is_published' => false]);
                            Notification::make()
                                ->success()
                                ->title('Yorumlar yayından kaldırıldı')
                                ->send();
                        }),
                ]),
            ])
            ->heading('İşletme Yorumları')
            ->description('Bu işletmenin tüm yorumları')
            ->emptyStateHeading('Henüz yorum yok')
            ->emptyStateDescription('Yukarıdaki "Yeni Yorum Ekle" butonundan yorum ekleyebilirsiniz.')
            ->emptyStateIcon('heroicon-o-chat-bubble-left-right');
    }
}

