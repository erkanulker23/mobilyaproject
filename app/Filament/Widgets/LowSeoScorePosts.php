<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BlogPostResource;
use App\Models\BlogPost;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LowSeoScorePosts extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 7;

    public function table(Table $table): Table
    {
        return $table
            ->heading('SEO İyileştirme Gereken Blog Yazıları')
            ->description('SEO skoru düşük yazıları iyileştirerek arama motoru sıralamanızı artırabilirsiniz.')
            ->query(
                BlogPost::query()
                    ->whereNotNull('seo_score')
                    ->where('seo_score', '<', 70)
                    ->orderBy('seo_score', 'asc')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('seo_score')
                    ->label('SEO Skoru')
                    ->formatStateUsing(function (BlogPost $record) {
                        $score = $record->seo_score ?? 0;
                        $grade = $record->getSeoGrade();
                        return "{$score}/100 ({$grade})";
                    })
                    ->badge()
                    ->color(function (BlogPost $record): string {
                        $score = $record->seo_score ?? 0;
                        if ($score >= 80) {
                            return 'success';
                        }
                        if ($score >= 60) {
                            return 'warning';
                        }
                        if ($score >= 40) {
                            return 'danger';
                        }
                        return 'gray';
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('improve')
                    ->label('İyileştir')
                    ->icon('heroicon-m-sparkles')
                    ->color('warning')
                    ->url(fn (BlogPost $record): string => BlogPostResource::getUrl('edit', ['record' => $record])),
            ]);
    }

    public static function canView(): bool
    {
        return BlogPost::whereNotNull('seo_score')->where('seo_score', '<', 70)->exists();
    }
}

