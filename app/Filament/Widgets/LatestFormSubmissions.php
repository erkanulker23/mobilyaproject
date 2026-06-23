<?php

namespace App\Filament\Widgets;

use App\Models\ContactFormSubmission;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestFormSubmissions extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Son Form Başvuruları')
            ->description('En son gelen form başvuruları')
            ->query(
                ContactFormSubmission::query()
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-posta')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefon')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-phone'),
                Tables\Columns\TextColumn::make('message')
                    ->label('Mesaj')
                    ->limit(40)
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Gönderim Tarihi')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->since(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalHeading('Form Detayları')
                    ->modalContent(fn (ContactFormSubmission $record) => view(
                        'filament.widgets.form-submission-detail',
                        ['record' => $record]
                    )),
            ]);
    }

    public static function canView(): bool
    {
        return true;
    }
}

