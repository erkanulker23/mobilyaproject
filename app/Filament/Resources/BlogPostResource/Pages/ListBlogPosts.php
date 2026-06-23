<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Actions\CreatePostWithGPTAction;
use App\Filament\Resources\BlogPostResource;
use App\Models\BlogPost;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogPosts extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
            CreatePostWithGPTAction::make()
                ->setModelClass(BlogPost::class),
        ];
    }
}
