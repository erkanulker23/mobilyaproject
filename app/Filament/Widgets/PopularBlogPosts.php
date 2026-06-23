<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BlogPostResource;
use App\Models\BlogPost;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PopularBlogPosts extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 8;

    public function table(Table $table): Table
    {
        return $table
            ->heading('En Popüler Blog Yazıları')
            ->description('Ziyaret sayısına göre en çok okunan blog yazıları')
            ->query(
                BlogPost::query()
                    ->withCount('visitLogs')
                    ->orderBy('visit_logs_count', 'desc')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->limit(50)
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('visit_logs_count')
                    ->label('Ziyaret')
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-m-eye')
                    ->default(0),
                Tables\Columns\TextColumn::make('share_count')
                    ->label('Paylaşım')
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-m-share')
                    ->default(0),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Öne Çıkan')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('publish_at')
                    ->label('Yayın Tarihi')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Görüntüle')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (BlogPost $record) => $record->url)
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('edit')
                    ->label('Düzenle')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (BlogPost $record): string => BlogPostResource::getUrl('edit', ['record' => $record])),
            ]);
    }

    public static function canView(): bool
    {
        return true;
    }
}

