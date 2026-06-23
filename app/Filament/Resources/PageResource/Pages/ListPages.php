<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = PageResource::class;

    public function getSubheading(): ?string
    {
        return 'Sitede yalnızca hakkimizda, mesafeli-satis, kvkk ve gizlilik slug\'ları kullanılır. "Kullanılmıyor" etiketli sayfalar adminde görünür ancak ön yüzde ayrı sayfa olarak açılmaz.';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
