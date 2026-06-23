<?php

namespace Modules\Comment\Filament\Resources;

use Closure;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Comment\Entities\Comment;
use Modules\Comment\Filament\Resources\CommentResource\Pages;
use Modules\Product\Entities\Product;
use App\Models\BlogPost;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function getModelLabel(): string
    {
        return __('comment::filament.comment');
    }

    public static function getPluralModelLabel(): string
    {
        return __('comment::filament.comments');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('commentable_type')
                    ->options(
                        array_flip(config('comment.available_commentables'))
                    )
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('commentable_id', null))
                    ->label(__('comment::filament.commentable_type')),
                Select::make('commentable_id')
                    ->searchable()
                    ->getSearchResultsUsing(function (string $search, $get) {
                        $className = $get('commentable_type');
                        $query = $className::filamentSearch($search);
                        if ($className === Product::class) {
                            $query->doesntHave('master_product');
                        }

                        return $query->pluck($className::getFilamentSearchLabel(), 'id');
                    })
                    ->getOptionLabelUsing(fn ($value, $get): ?string => $get('commentable_type')::find($value)?->getFilamentSearchOptionName())
                    ->hidden(fn ($get) => $get('commentable_type') == null)
                    ->label(__('comment::filament.commentable')),

                Select::make('commented_type')
                    ->options(
                        array_flip(config('comment.available_commenteds'))
                    )
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('commented_id', null))
                    ->label(__('comment::filament.commented_type')),
                Select::make('commented_id')
                    ->searchable()
                    ->getSearchResultsUsing(function (string $search, $get) {
                        $className = $get('commented_type');

                        return $className::filamentSearch($search)->pluck($className::getFilamentSearchLabel(), 'id');
                    })
                    ->getOptionLabelUsing(fn ($value, $get): ?string => $get('commented_type')::find($value)?->getFilamentSearchOptionName())
                    ->hidden(fn ($get) => $get('commented_type') == null)
                    ->label(__('comment::filament.commented')),
                TextInput::make('fullname')
                    ->label('Kullanıcı Adı ve Soyadı'),
                TextInput::make('email')
                    ->label('E-posta Adresi')
                    ->email(),
                Grid::make()
                    ->columns(1)
                    ->schema([
                        Textarea::make('comment')->required(),
                    ]),
                Checkbox::make('is_approved')
                    ->label(__('comment::filament.is_approved')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('commentable_type')
                    ->label('İçerik Türü')
                    ->formatStateUsing(function ($state) {
                        return match($state) {
                            'Modules\\Product\\Entities\\Product' => 'Ürün',
                            'App\\Models\\BlogPost' => 'Blog Yazısı',
                            default => $state
                        };
                    }),
                TextColumn::make('commentable_id')
                    ->label('İçerik')
                    ->formatStateUsing(function ($record) {
                        if ($record->commentable_type === 'App\\Models\\BlogPost') {
                            $blogPost = BlogPost::find($record->commentable_id);
                            return $blogPost ? $blogPost->title : 'Bulunamadı';
                        } elseif ($record->commentable_type === 'Modules\\Product\\Entities\\Product') {
                            $product = Product::find($record->commentable_id);
                            return $product ? $product->name : 'Bulunamadı';
                        }
                        return $record->commentable_id;
                    }),
                TextColumn::make('fullname')
                    ->label('Kullanıcı')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('E-posta')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('comment')
                    ->label('Yorum')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                TextColumn::make('created_at')
                    ->label('Tarih')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                CheckboxColumn::make('is_approved')
                    ->label('Onaylı'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('commentable_type')
                    ->label('İçerik Türü')
                    ->options([
                        'App\\Models\\BlogPost' => 'Blog Yazısı',
                        'Modules\\Product\\Entities\\Product' => 'Ürün',
                    ]),
                Tables\Filters\TernaryFilter::make('is_approved')
                    ->label('Onay Durumu')
                    ->trueLabel('Onaylanmış')
                    ->falseLabel('Onay Bekleyen')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\Action::make('go_to_content')
                    ->label('Yazıya Git')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('info')
                    ->url(function ($record) {
                        if ($record->commentable_type === 'App\\Models\\BlogPost') {
                            $blogPost = \App\Models\BlogPost::find($record->commentable_id);
                        if ($blogPost) {
                            return route('tr.blog.post.show', $blogPost->slug);
                        }
                        }

                        return '#';
                    })
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Onayla')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) => !$record->is_approved)
                    ->action(function ($record) {
                        $record->update(['is_approved' => true]);
                    })
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('reject')
                    ->label('Reddet')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn ($record) => $record->is_approved)
                    ->action(function ($record) {
                        $record->update(['is_approved' => false]);
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('approve_selected')
                    ->label('Seçilenleri Onayla')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function ($records) {
                        $records->each(function ($record) {
                            $record->update(['is_approved' => true]);
                        });
                    })
                    ->requiresConfirmation(),
                Tables\Actions\BulkAction::make('reject_selected')
                    ->label('Seçilenleri Reddet')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->action(function ($records) {
                        $records->each(function ($record) {
                            $record->update(['is_approved' => false]);
                        });
                    })
                    ->requiresConfirmation(),
            ]);
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }

    public static function getSlug(): string
    {
        if (filled(static::$slug)) {
            return static::$slug;
        }

        return Str::of(static::getModel())
            ->afterLast('\\Entities\\')
            ->plural()
            ->explode('\\')
            ->map(fn (string $string) => Str::of($string)->kebab()->slug())
            ->implode('/');
    }
}
