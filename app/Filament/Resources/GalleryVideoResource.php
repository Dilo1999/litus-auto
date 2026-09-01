<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryVideoResource\Pages;
use App\Models\GalleryVideo;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;

class GalleryVideoResource extends Resource
{
    protected static ?string $model = GalleryVideo::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    protected static ?string $navigationGroup = 'Gallery';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'TikTok Videos';

    protected static ?string $modelLabel = 'TikTok Video';

    protected static ?string $pluralModelLabel = 'TikTok Videos';

    protected static ?string $slug = 'gallery-videos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Video details')
                    ->description('Shown in the Video Gallery carousel on the Gallery page.')
                    ->schema([
                        TextInput::make('video_url')
                            ->label('TikTok video link')
                            ->required()
                            ->url()
                            ->maxLength(500)
                            ->placeholder('https://www.tiktok.com/@litus.automobiles/video/...')
                            ->helperText('Paste the full TikTok video URL.')
                            ->columnSpanFull(),
                        TextInput::make('title')
                            ->label('Caption')
                            ->maxLength(255)
                            ->placeholder('Optional caption shown on the video card')
                            ->columnSpanFull(),
                        FileUpload::make('thumbnail')
                            ->label('Thumbnail image')
                            ->image()
                            ->directory('gallery/videos')
                            ->disk('public')
                            ->preserveFilenames()
                            ->helperText('Portrait image recommended (9:16). If empty, TikTok oEmbed or a fallback image is used.')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Display settings')
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Published')
                            ->helperText('Unpublished videos are hidden from the website.')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->getStateUsing(fn (GalleryVideo $record): string => $record->thumbnailUrl())
                    ->height(72),
                TextColumn::make('title')
                    ->label('Caption')
                    ->placeholder('—')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('video_url')
                    ->label('TikTok link')
                    ->limit(42)
                    ->tooltip(fn (GalleryVideo $record): string => $record->video_url),
                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleryVideos::route('/'),
            'create' => Pages\CreateGalleryVideo::route('/create'),
            'edit' => Pages\EditGalleryVideo::route('/{record}/edit'),
        ];
    }
}
