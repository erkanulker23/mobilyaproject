<?php

namespace Modules\Members\Filament\Resources;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Modules\Members\Entities\Member;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'Takım Üyesi';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Takım Üyeleri';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('firstname')
                    ->label('Adı')
                    ->required(),
                TextInput::make('lastname')
                    ->label('Soyadı')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email(),
                TextInput::make('phone')
                    ->label('Telefon Numarası'),
                TextInput::make('position')
                    ->label('Ünvanı'),
                FileUpload::make('photo')
                    ->label('Fotoğraf')
                    ->directory('members')
                    ->required()
                    ->placeholder('Photo of the member')
                    ->image()
                    ->imageEditor(),
                Section::make('social_media_links')
                    ->heading('Sosyal Medya Linkleri')
                    ->columns(1)
                    ->description('Sosyal medya linklerinizi buradan ekleyebilirsiniz.')
                    ->schema([
                        Repeater::make('social_media_links')
                            ->schema([
                                Select::make('type')
                                    ->label('Tip')
                                    ->required()
                                    ->options([
                                        'facebook' => 'Facebook',
                                        'twitter' => 'Twitter',
                                        'instagram' => 'Instagram',
                                        'youtube' => 'Youtube',
                                        'linkedin' => 'Linkedin',
                                    ]),
                                TextInput::make('display_name')
                                    ->label('Görünen İsim'),
                                TextInput::make('custom_icon')
                                    ->label('İkon'),
                                IconPicker::make('icon')
                                    ->columns([
                                        'default' => 1,
                                        'lg' => 3,
                                        '2xl' => 5,
                                    ])
                                    ->sets([
                                        'fontawesome-brands',
                                        'fontawesome-regular',
                                        'fontawesome-regular',
                                    ])
                                    ->label('İkon'),
                                TextInput::make('link')
                                    ->label('Link')
                                    ->required()
                                    ->url(),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Fotoğraf'),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Adı Soyadı')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Ünvan')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => \Modules\Members\Filament\Resources\MemberResource\Pages\ListMembers::route('/'),
            'create' => \Modules\Members\Filament\Resources\MemberResource\Pages\CreateMember::route('/create'),
            'edit' => \Modules\Members\Filament\Resources\MemberResource\Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
