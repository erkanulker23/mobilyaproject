<?php

namespace App\Filament\Resources\ProjectCategoryResource\Pages;

use App\Filament\Resources\ProjectCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectCategories extends ListRecords
{
    protected static string $resource = ProjectCategoryResource::class;

    public function getTitle(): string
    {
        return 'Ürün Kategorileri';
    }

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
