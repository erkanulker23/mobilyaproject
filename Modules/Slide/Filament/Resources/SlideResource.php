<?php

namespace Modules\Slide\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Slide\Entities\Slide;
use Modules\Slide\Entities\Slider;
use Modules\Slide\Filament\Resources\SlideResource\Pages;

class SlideResource extends Resource
{
    use Translatable;

    protected static ?string $model = Slide::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('slide::filament.slides_and_sliders');
    }

    public static function getModelLabel(): string
    {
        return __('slide::filament.slide');
    }

    public static function getPluralModelLabel(): string
    {
        return __('slide::filament.slides');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Media')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->required(fn ($get) => $get('target_type') === null)
                            ->label(__('slide::filament.image')),
                        SpatieMediaLibraryFileUpload::make('mobile_image')
                            ->collection('mobile_image')
                            ->required(fn ($get) => $get('target_type') === null)
                            ->label(__('slide::filament.mobile_image')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Slider Settings')
                    ->schema([
                        Select::make('slider_id')
                            ->options(Slider::select(DB::raw('id, title as name'))->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->label(__('slide::filament.slider')),
                        Forms\Components\TextInput::make('order_column')
                            ->numeric()
                            ->maxLength(255)
                            ->label(__('slide::filament.order')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Title Settings')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->helperText('Maksimum 255 karakter girilebilir.')
                            ->maxLength(255)
                            ->label(__('slide::filament.title')),
                        Forms\Components\ColorPicker::make('title_color')
                            ->label(__('slide::filament.title_color')),
                        Forms\Components\Toggle::make('show_title_on_mobile')
                            ->label(__('slide::filament.show_title_on_mobile'))
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Content Settings')
                    ->schema([
                        Forms\Components\TextInput::make('content')
                            ->helperText('Maksimum 255 karakter girilebilir.')
                            ->maxLength(255)
                            ->label(__('slide::filament.content')),
                        Forms\Components\ColorPicker::make('content_color')
                            ->label(__('slide::filament.content_color')),
                        Forms\Components\Toggle::make('show_content_on_mobile')
                            ->label(__('slide::filament.show_content_on_mobile'))
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Subtitle Settings')
                    ->schema([
                        Forms\Components\TextInput::make('subtitle')
                            ->helperText('Maksimum 255 karakter girilebilir.')
                            ->maxLength(255)
                            ->label(__('slide::filament.subtitle')),
                        Forms\Components\ColorPicker::make('subtitle_color')
                            ->label(__('slide::filament.subtitle_color')),
                        Forms\Components\Toggle::make('show_subtitle_on_mobile')
                            ->label(__('slide::filament.show_subtitle_on_mobile'))
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Link Settings')
                    ->schema([
                        Select::make('target_type')
                            ->options(
                                array_flip(config('slide.target_types'))
                            )
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('target_id', null))
                            ->label(__('slide::filament.target_type')),
                        Select::make('target_id')
                            ->searchable()
                            ->getSearchResultsUsing(function (string $search, callable $get) {
                                $className = $get('target_type');
                                return $className::filamentSearch($search)->pluck($className::getFilamentSearchLabel(), 'id');
                            })
                            ->getOptionLabelUsing(fn ($value, callable $get): ?string => $get('target_type')::find($value)?->getFilamentSearchOptionName())
                            ->hidden(fn ($get) => $get('target_type') == null)
                            ->label(__('slide::filament.target')),
                        Forms\Components\TextInput::make('cta_text')
                            ->helperText('Maksimum 255 karakter girilebilir. Eğer buton yazısı eklemezseniz buton görünmeyecektir.')
                            ->maxLength(255)
                            ->label(__('slide::filament.cta_text')),
                        Forms\Components\TextInput::make('link_url')
                            ->maxLength(255)
                            ->hidden(fn ($get) => $get('target_type') != null)
                            ->label(__('slide::filament.link_url')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Publishing Settings')
                    ->schema([
                        Forms\Components\DateTimePicker::make('publish_at')
                            ->default(now())
                            ->label(__('slide::filament.publish_at'))
                            ->required(),
                        Forms\Components\DateTimePicker::make('unpublish_at')
                            ->label(__('slide::filament.unpublish_at')),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->label(__('slide::filament.image')),
                TextColumn::make('title')
                    ->wrap()
                    ->label(__('slide::filament.title')),
                TextColumn::make('slider.title')
                    ->label(__('slide::filament.slider')),
                TextColumn::make('publish_at')->dateTime(),
                TextColumn::make('unpublish_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column');
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
            'index' => Pages\ListSlides::route('/'),
            'create' => Pages\CreateSlide::route('/create'),
            'edit' => Pages\EditSlide::route('/{record}/edit'),
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
