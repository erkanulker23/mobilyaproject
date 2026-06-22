<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Str;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('bulkImport')
                ->label('Toplu Yükle (CSV)')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('gray')
                ->schema([
                    Placeholder::make('info')
                        ->label('CSV biçimi')
                        ->content('Sütunlar: ad_tr, ad_en, kategori_slug, gorsel (opsiyonel). İlk satır başlık olabilir.'),
                    FileUpload::make('file')
                        ->label('CSV dosyası')
                        ->acceptedFileTypes(['text/csv', 'text/plain', 'application/vnd.ms-excel'])
                        ->storeFiles(false)
                        ->required(),
                ])
                ->action(function (array $data) {
                    /** @var \Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file */
                    $file = $data['file'];
                    $rows = array_map('str_getcsv', preg_split('/\r?\n/', trim($file->get())));
                    $created = 0;
                    $cats = Category::pluck('id', 'slug');

                    foreach ($rows as $i => $row) {
                        $tr = trim($row[0] ?? '');
                        // Başlık satırını atla
                        if ($i === 0 && in_array(mb_strtolower($tr), ['ad_tr', 'tr', 'ad', 'name'])) {
                            continue;
                        }
                        if ($tr === '') {
                            continue;
                        }
                        $en = trim($row[1] ?? '') ?: $tr;
                        $catSlug = trim($row[2] ?? '');
                        $img = trim($row[3] ?? '');

                        Product::create([
                            'tr'          => $tr,
                            'en'          => $en,
                            'slug'        => Str::slug($tr) . '-' . Str::random(4),
                            'category_id' => $cats[$catSlug] ?? $cats->first(),
                            'img'         => $img ?: null,
                            'sort'        => 0,
                        ]);
                        $created++;
                    }

                    Notification::make()
                        ->title("$created ürün içe aktarıldı.")
                        ->success()
                        ->send();
                }),
        ];
    }
}
