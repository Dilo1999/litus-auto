<?php

namespace App\Filament\Resources\MotorcycleResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class ColorVariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'colorVariants';

    protected static ?string $recordTitleAttribute = 'label';

    protected static ?string $title = 'Color Variants';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Color details')
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('e.g. Green'),
                        ColorPicker::make('hex_color')
                            ->required()
                            ->label('Color swatch'),
                        Toggle::make('is_default')
                            ->label('Default color')
                            ->helperText('Shown first on the product page.'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('360° spin images')
                    ->description('Upload all frames in one go, in rotation order (frame 1 → frame 2 → …). Use the same number of frames for each color.')
                    ->schema([
                        FileUpload::make('spin_frames')
                            ->label('360° frames')
                            ->multiple()
                            ->image()
                            ->directory('motorcycles/spin')
                            ->preserveFilenames()
                            ->maxFiles(72)
                            ->helperText('Order follows upload sequence. The product page drag-to-rotate uses this order.'),
                    ]),

                Forms\Components\Section::make('Gallery images')
                    ->schema([
                        FileUpload::make('gallery_images')
                            ->label('Gallery thumbnails')
                            ->multiple()
                            ->image()
                            ->directory('motorcycles/gallery')
                            ->preserveFilenames()
                            ->maxFiles(12)
                            ->helperText('Upload in display order. Shown when this color is selected.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')->searchable()->sortable(),
                ColorColumn::make('hex_color')->label('Swatch'),
                TextColumn::make('spin_frames')
                    ->label('360 frames')
                    ->getStateUsing(fn ($record) => self::countUploadedImages($record->spin_frames))
                    ->formatStateUsing(fn ($state) => self::formatImageCount((int) $state)),
                TextColumn::make('gallery_images')
                    ->label('Gallery')
                    ->getStateUsing(fn ($record) => self::countUploadedImages($record->gallery_images))
                    ->formatStateUsing(fn ($state) => self::formatImageCount((int) $state)),
                IconColumn::make('is_default')->boolean()->label('Default'),
            ])
            ->defaultSort('label')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('New color variant'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    private static function countUploadedImages(mixed $images): int
    {
        if (is_array($images)) {
            return count(array_filter($images));
        }

        if (is_string($images) && $images !== '') {
            $decoded = json_decode($images, true);

            return is_array($decoded) ? count(array_filter($decoded)) : 0;
        }

        return 0;
    }

    private static function formatImageCount(int $count): string
    {
        return $count.' '.($count === 1 ? 'image' : 'images');
    }
}
