<?php

namespace App\Filament\Concerns;

use App\Models\GalleryImage;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
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

    public static function getCreateFormSchema(): array
    {
        return [
            Forms\Components\Section::make(static::getCategoryLabel().' gallery')
                ->description('Upload multiple images at once. They appear under “'.static::getCategoryLabel().'” on the Gallery page.')
                ->schema([
                    Hidden::make('category')
                        ->default(static::getCategory())
                        ->dehydrated(),
                    FileUpload::make('images')
                        ->label('Gallery images')
                        ->image()
                        ->multiple()
                        ->directory('gallery/'.static::getCategory())
                        ->disk('public')
                        ->preserveFilenames()
                        ->required()
                        ->maxFiles(40)
                        ->helperText('Select one or more images. Recommended: landscape photos, at least 1200px wide.')
                        ->columnSpanFull(),
                ])
                ->columns(1),

            Forms\Components\Section::make('Display settings')
                ->description('These settings apply to every image uploaded in this batch.')
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
        ];
    }

    public static function getEditFormSchema(): array
    {
        return [
            Forms\Components\Section::make(static::getCategoryLabel().' image')
                ->description('Update this gallery image.')
                ->schema([
                    Hidden::make('category')
                        ->default(static::getCategory())
                        ->dehydrated(),
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
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema(static::getEditFormSchema());
    }

    public static function createGalleryRecords(array $data): GalleryImage
    {
        $images = collect($data['images'] ?? [])
            ->filter(fn ($path) => filled($path))
            ->values();

        if ($images->isEmpty()) {
            throw new \InvalidArgumentException('Please upload at least one image.');
        }

        $category = $data['category'] ?? static::getCategory();
        $isFeatured = (bool) ($data['is_featured'] ?? false);
        $isPublished = array_key_exists('is_published', $data) ? (bool) $data['is_published'] : true;

        $first = null;

        foreach ($images as $path) {
            $record = GalleryImage::query()->create([
                'category' => $category,
                'title' => null,
                'image' => $path,
                'is_featured' => $isFeatured,
                'is_published' => $isPublished,
            ]);

            $first ??= $record;
        }

        return $first;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Preview')
                    ->getStateUsing(fn (GalleryImage $record): string => $record->imageUrl())
                    ->height(56),
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
