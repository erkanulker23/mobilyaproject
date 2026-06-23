<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Order\Entities\Order;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    public static function getModelLabel(): string
    {
        return __('user_resource.model_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('user_resource.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('user_resource.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('surname')
                    ->label(__('user_resource.surname'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label(__('user_resource.email'))
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label(__('user_resource.email_verified_at'))
                    ->helperText('Eğer geçerli bir tarih girilirse kullanıcı e-posta adresini doğrulamış sayılır.'),
                Forms\Components\DateTimePicker::make('last_active_at')
                    ->label(__('user_resource.last_active_at'))
                    ->disabled(),
                Forms\Components\Select::make('roles')
                    ->multiple()
                    ->preload()
                    ->relationship('roles', 'name', fn (Builder $query) => $query->where('name', '!=', 'superadmin'))
                    ->label(__('user_resource.roles')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->label(__('user_resource.fullname')),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('user_resource.email')),
                Tables\Columns\IconColumn::make('is_verified')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()
                    ->label(__('user_resource.created_at')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make()
                    ->before(
                        function ($records, Tables\Actions\ForceDeleteBulkAction $action) {
                            foreach ($records as $record) {
                                $ids = $record->orders()->pluck('id')->toArray();
                                $exists = Order::whereIn('user_id', $ids)->exists();
                                if ($exists) {
                                    Notification::make()
                                        ->title('Errors!')
                                        ->body("{$record->fullname} has orders. You can't force delete this user.")
                                        ->status('danger')
                                        ->send();
                                    $action->cancel();
                                }
                            }
                        }
                    )
                    ->deselectRecordsAfterCompletion(),
                Tables\Actions\RestoreBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if (auth()->user()->hasRole('superadmin')) {
            return $query;
        }

        $superAdminIds = User::role('superadmin')->pluck('id')->toArray();

        return $query->whereNotIn('id', $superAdminIds);
    }
}
