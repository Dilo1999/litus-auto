<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShowroomResource\Pages;
use App\Models\Showroom;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;

class ShowroomResource extends Resource
{
    protected static ?string $model = Showroom::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static ?string $navigationGroup = 'Locations';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Showrooms & Centres';

    protected static ?string $modelLabel = 'Showroom';

    protected static ?string $pluralModelLabel = 'Showrooms & Centres';

    protected static ?string $slug = 'showrooms';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Location details')
                    ->description('Shown on About, Contact and Home under Showrooms and service centres.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. Malé Showroom'),
                        TextInput::make('address')
                            ->required()
                            ->maxLength(500)
                            ->columnSpanFull(),
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(40)
                            ->placeholder('+960 779 7442'),
                        CheckboxList::make('services')
                            ->options(Showroom::SERVICE_OPTIONS)
                            ->columns(2)
                            ->helperText('Tags shown on the showroom card (Sales, Service Centre, Parts, Support).')
                            ->columnSpanFull(),
                        Toggle::make('offers_pick_drop')
                            ->label('Pick & drop service area')
                            ->helperText('Show this location in the Service Areas dropdown on the Service Centre page.')
                            ->reactive()
                            ->columnSpanFull(),
                        TextInput::make('pick_drop_label')
                            ->label('Service area label')
                            ->maxLength(120)
                            ->placeholder('e.g. Malé')
                            ->helperText('Short name shown in the pick & drop dropdown. Leave blank to use the location name.')
                            ->visible(fn (callable $get): bool => (bool) $get('offers_pick_drop'))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Images')
                    ->schema([
                        FileUpload::make('images')
                            ->label('Showroom photos')
                            ->image()
                            ->multiple()
                            ->directory('showrooms')
                            ->disk('public')
                            ->preserveFilenames()
                            ->helperText('Upload one or more photos. The first image is the cover; extras rotate in the card slider.')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Display settings')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->helperText('Optional highlight flag for future use on the home page.')
                            ->default(false),
                        Toggle::make('is_published')
                            ->label('Published')
                            ->helperText('Unpublished locations are hidden from the website.')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover')
                    ->label('Preview')
                    ->getStateUsing(fn (Showroom $record): ?string => $record->coverImageUrl())
                    ->height(56),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('offers_pick_drop')
                    ->label('Pick & drop')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label('Published'),
                TernaryFilter::make('is_featured')
                    ->label('Featured'),
                TernaryFilter::make('offers_pick_drop')
                    ->label('Pick & drop area'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShowrooms::route('/'),
            'create' => Pages\CreateShowroom::route('/create'),
            'edit' => Pages\EditShowroom::route('/{record}/edit'),
        ];
    }
}
