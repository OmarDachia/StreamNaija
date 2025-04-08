<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\RelationManagers;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Checkbox;
use App\Models\Category as Categories;
use Filament\Forms\Components\Placeholder;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Video Information')
                    ->Description('This is the information about the Video.')
                    ->schema([
                        Forms\Components\TextInput::make('id')
                            ->disabled()
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('category_id')
                            ->required()
                            ->relationship('category', 'name')
                            ->options(Categories::all()->pluck('name', 'id')->toArray()),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->rows(5)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('views')
                            ->required()
                            ->numeric()
                            ->columnSpanFull()
                            ->default(0),
                ])->columnSpan(2)->columns(2),
                Group::make()
                    ->schema([
                        Section::make('Image Information')
                        ->Description('This is the meta information about the Image of this Video.')
                        ->schema([
                            Forms\Components\FileUpload::make('thumbnail_url')
                                ->label('Thumbnail')
                                ->image()
                                ->disk('public')->directory('thumbnails')
                                ->required(),
                        ])->columnSpan(1),
                        Section::make('Meta Information')
                        ->Description('This is the meta information about the post.')
                        ->schema([
                            Forms\Components\FileUpload::make('video_url')
                                ->label('Video')
                                ->image()
                                ->disk('public')->directory('Videos')
                                ->required(),
                            Checkbox::make('is_published')
                                    ->label('Is Published'),
                        ])->columnSpan(1),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('video_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('thumbnail_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('views')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\CheckboxColumn::make('is_published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
