<?php

namespace App\Filament\Concerns;

use App\Models\GalleryImage;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait ManagesCategoryGalleryImages
{
    abstract public static function getCategory(): string;

    abstract public static function getCategoryLabel(): string;

    public static function getModelLabel(): string
    {
        return static::getCategoryLabel().' Image';
    }

    public static function getPluralModelLabel(): string
    {
        return static::getCategoryLabel().' Images';
    }

    public static function getNavigationLabel(): string
    {
        return static::getCategoryLabel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(static::getCategoryLabel().' image')
                    ->description('Images in this table appear under “'.static::getCategoryLabel().'” on the Gallery page.')
                    ->schema([
                        Hidden::make('category')
                            ->default(static::getCategory())
                            ->dehydrated(),
                        TextInput::make('title')
                            ->label('Title / caption')
                            ->maxLength(255)
                            ->placeholder('Optional — shown on featured moment cards')
                            ->helperText('Leave blank if you do not want a title on the card.'),
                        FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->directory('gallery/'.static::getCategory())
                            ->disk('public')
                            ->preserveFilenames()
                            ->required()
                            ->helperText('Recommended: landscape photo, at least 1200px wide.')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Display settings')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Featured in Explore Moments')
                            ->helperText('Featured images appear in the top “Explore LITUS Moments” section.')
                            ->default(false),
                        Toggle::make('is_published')
                            ->label('Published')
                            ->helperText('Unpublished images are hidden from the website.')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Preview')
                    ->getStateUsing(fn (GalleryImage $record): string => $record->imageUrl())
                    ->height(56),
                TextColumn::make('title')
                    ->label('Title')
                    ->placeholder('—')
                    ->searchable()
                    ->limit(40),
                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                TernaryFilter::make('is_featured')
                    ->label('Featured'),
                TernaryFilter::make('is_published')
                    ->label('Published'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('category', static::getCategory())
            ->ordered();
    }

    public static function canView(Model $record): bool
    {
        return $record->category === static::getCategory();
    }

    public static function canEdit(Model $record): bool
    {
        return $record->category === static::getCategory();
    }

    public static function canDelete(Model $record): bool
    {
        return $record->category === static::getCategory();
    }
}
