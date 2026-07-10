<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MotorcycleResource\Pages;
use App\Filament\Resources\MotorcycleResource\RelationManagers\ColorVariantsRelationManager;
use App\Models\Motorcycle;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class MotorcycleResource extends Resource
{
    protected static ?string $model = Motorcycle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Motorcycles';

    protected static ?string $modelLabel = 'Motorcycle';

    protected static ?string $pluralModelLabel = 'Motorcycles';

    protected static ?string $navigationGroup = 'Catalog';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Product info')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('category')
                            ->maxLength(255)
                            ->placeholder('e.g. Touring Bikes'),
                        TextInput::make('brand')
                            ->maxLength(255)
                            ->placeholder('e.g. Honda'),
                        FileUpload::make('card_image')
                            ->label('Card image')
                            ->image()
                            ->directory('motorcycles/cards')
                            ->preserveFilenames()
                            ->helperText('Shown on the motorcycles listing page. Recommended: square or landscape product shot on a white background.')
                            ->columnSpanFull(),
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true),
                        Toggle::make('is_top_selling')
                            ->label('Top Selling')
                            ->helperText('Show this motorcycle in the Top Selling Rides section on the home page.')
                            ->default(false),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pricing & offer')
                    ->schema([
                        TextInput::make('original_price')
                            ->required()
                            ->numeric()
                            ->prefix('MVR')
                            ->step(0.01),
                        Toggle::make('has_promotion')
                            ->label('Promotion active')
                            ->helperText('Enable to set a sale price and promotional offer for this product.')
                            ->default(false)
                            ->reactive()
                            ->columnSpanFull(),
                        TextInput::make('sale_price')
                            ->numeric()
                            ->prefix('MVR')
                            ->step(0.01)
                            ->required(fn (callable $get) => (bool) $get('has_promotion'))
                            ->hidden(fn (callable $get) => ! $get('has_promotion')),
                        Textarea::make('offer_note')
                            ->rows(2)
                            ->placeholder('e.g. This offer valid for Green, Brown Colors.')
                            ->hidden(fn (callable $get) => ! $get('has_promotion'))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Specifications')
                    ->description('Labels are fixed. Enter the value for each specification only. The first 4 appear as highlight cards on the product page.')
                    ->schema([
                        Repeater::make('specs')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Specification')
                                    ->disabled()
                                    ->dehydrated(),
                                TextInput::make('value')
                                    ->label('Value')
                                    ->maxLength(255),
                            ])
                            ->default(fn () => Motorcycle::defaultSpecsTemplate())
                            ->afterStateHydrated(function (Repeater $component, ?array $state): void {
                                $component->state(Motorcycle::normalizeSpecs($state));
                            })
                            ->columns(2)
                            ->collapsible()
                            ->disableItemCreation()
                            ->disableItemDeletion()
                            ->disableItemMovement()
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category')->searchable(),
                IconColumn::make('has_promotion')->boolean()->label('Promotion'),
                IconColumn::make('is_top_selling')->boolean()->label('Top Selling'),
                TextColumn::make('colors')
                    ->label('Colors')
                    ->getStateUsing(function (Motorcycle $record): \Illuminate\Support\HtmlString {
                        $variants = $record->colorVariants;

                        if ($variants->isEmpty()) {
                            return new \Illuminate\Support\HtmlString('<span style="color:#9ca3af;">—</span>');
                        }

                        $swatches = $variants->map(function ($variant) {
                            $hex = e($variant->hex_color ?: '#d1d5db');
                            $label = e($variant->label ?: 'Color');

                            return '<span title="'.$label.'" style="display:inline-block;width:22px;height:22px;border-radius:6px;background:'.$hex.';border:1px solid rgba(0,0,0,0.12);"></span>';
                        })->implode('');

                        return new \Illuminate\Support\HtmlString(
                            '<span style="display:inline-flex;align-items:center;gap:8px;">'.$swatches.'</span>'
                        );
                    })
                    ->html(),
                IconColumn::make('is_published')->boolean()->label('Published'),
            ])
            ->defaultSort('name')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['colorVariants' => fn ($q) => $q->orderBy('sort_order')]);
    }

    public static function getRelations(): array
    {
        return [
            ColorVariantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMotorcycles::route('/'),
            'create' => Pages\CreateMotorcycle::route('/create'),
            'edit' => Pages\EditMotorcycle::route('/{record}/edit'),
        ];
    }
}
