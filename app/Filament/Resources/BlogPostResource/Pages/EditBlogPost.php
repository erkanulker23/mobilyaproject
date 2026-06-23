<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogPost extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('show_blog_post')
                ->label('Yazıyı Görüntüle')
                ->icon('heroicon-o-arrow-right')
                ->url($this->record->url),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
