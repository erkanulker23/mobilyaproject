<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    /**
     * @return string|null
     */
    public static function getModelLabel(): string
    {
        return 'Şube';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Şubeler';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::branchFields());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('county'),
                Tables\Columns\TextColumn::make('address'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ReplicateAction::make()
                    ->form(self::branchFields())
                    ->beforeReplicaSaved(function (Branch $replica, array $data): void {
                        $replica->fill($data);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    protected static function branchFields()
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Şube Adı')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('link')
                ->label('Link')
                ->helperText('Şube için ayrı bir web sitesi varsa veya google maps linkini buraya yazabilirsiniz.')
                ->maxLength(255),
            Forms\Components\Textarea::make('maps_iframe')
                ->label('Google Maps Iframe')
                ->columnSpanFull()
                ->helperText('Google Maps Iframe kodunu buraya yapıştırabilirsiniz.'),
            Forms\Components\Section::make('contact')
                ->heading('İletişim Bilgileri')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('email')
                        ->label('E-Posta Adresi')
                        ->email()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('phone')
                        ->label('Telefon Numarası')
                        ->tel()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('fax')
                        ->label('Fax Numarası')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('whatsapp')
                        ->label('Whatsapp Numarası')
                        ->maxLength(255),
                ]),
            Forms\Components\Section::make('location')
                ->heading('Konum Bilgileri')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('country')
                        ->label('Ülke')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('city')
                        ->label('Şehir')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('county')
                        ->label('İlçe')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('address')
                        ->label('Adres')
                        ->maxLength(255),
                ]),
            Forms\Components\Section::make('opening_and_closing_times')
                ->heading('Açılış ve Kapanış Saatleri')
                ->description('Şube açılış ve kapanış saatlerini buradan düzenleyebilirsiniz.')
                ->columns(2)
                ->schema([
                    Forms\Components\TimePicker::make('weekdays_opening')
                        ->label('Hafta İçi Açılış Saati')
                        ->withoutSeconds(),
                    Forms\Components\TimePicker::make('weekdays_closing')
                        ->label('Hafta İçi Kapanış Saati')
                        ->withoutSeconds(),
                    Forms\Components\TimePicker::make('weekend_opening')
                        ->label('Hafta Sonu Açılış Saati')
                        ->withoutSeconds(),
                    Forms\Components\TimePicker::make('weekend_closing')
                        ->label('Hafta Sonu Kapanış Saati')
                        ->withoutSeconds(),
                ]),
        ];
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
