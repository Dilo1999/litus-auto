<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MotorcycleResource\Pages;
use App\Filament\Resources\MotorcycleResource\RelationManagers\ColorVariantsRelationManager;
use App\Models\Motorcycle;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use App\Models\IjaraPlan;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ToggleColumn;
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
                            ->maxSize(700)
                            ->directory('motorcycles/cards')
                            ->preserveFilenames()
                            ->helperText('Shown on the motorcycles listing page. Recommended: square or landscape product shot on a white background. Maximum file size: 700KB.')
                            ->columnSpanFull(),
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true),
                        Toggle::make('is_top_selling')
                            ->label('Top selling')
                            ->helperText('Show this model in the home page “Top selling rides” section.')
                            ->default(false),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Ijara plans')
                    ->description('Choose whether this model can be leased on an Ijara plan, and which plans it is offered on. Switch a plan on to enter the down payment for this bike on that plan. This controls the payment calculator and the Ijara links on its page.')
                    ->schema([
                        Toggle::make('ijara_enabled')
                            ->label('Available on Ijara plans')
                            ->default(true)
                            ->reactive(),
                        Forms\Components\Group::make(static::ijaraPlanFields())
                            ->visible(fn (\Closure $get) => (bool) $get('ijara_enabled'))
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Pricing')
                    ->description('Promotional sale prices are managed under Catalog → Promotions.')
                    ->schema([
                        TextInput::make('original_price')
                            ->required()
                            ->numeric()
                            ->prefix('MVR')
                            ->step(0.01),
                    ]),

                Forms\Components\Section::make('Specifications')
                    ->description('Labels are fixed. Enter the value for each specification only. The first 4 appear as highlight cards on the product page.')
                    ->schema(
                        collect(Motorcycle::specGroupDefinitions())
                            ->map(function (array $group) {
                                return Forms\Components\Section::make($group['title'])
                                    ->schema(
                                        collect($group['labels'])
                                            ->map(fn (string $label) => TextInput::make('spec_values.'.$label)
                                                ->label($label)
                                                ->maxLength(255))
                                            ->all()
                                    )
                                    ->columns(2)
                                    ->collapsible();
                            })
                            ->all()
                    ),
            ]);
    }

    /**
     * One row per Ijara plan: a switch for the plan and, only while it is on, this bike's down payment for it.
     * Stored in motorcycles.ijara_rates as [plan => ['down' => amount]]; the switches also drive ijara_plans
     * (see ijaraDataForSave / ijaraDataForForm).
     *
     * @return array<int, Forms\Components\Component>
     */
    protected static function ijaraPlanFields(): array
    {
        try {
            $plans = IjaraPlan::query()->orderBy('sort_order')->get();
        } catch (\Throwable) {
            return [];
        }

        return $plans->map(function (IjaraPlan $plan) {
            $enabled = "ijara_rates.{$plan->slug}.enabled";

            return Forms\Components\Grid::make(['default' => 1, 'md' => 2])
                ->extraAttributes(['class' => 'rounded-lg border border-gray-200 p-4'])
                ->schema([
                    Toggle::make($enabled)
                        ->label($plan->name.($plan->tag ? " - {$plan->tag}" : ''))
                        ->default(false)
                        ->reactive(),
                    TextInput::make("ijara_rates.{$plan->slug}.down")
                        ->label('Down payment')
                        ->prefix('MVR')
                        ->numeric()
                        ->minValue(0)
                        ->required()
                        ->visible(fn (\Closure $get) => (bool) $get($enabled)),
                ]);
        })->all();
    }

    /** Form state -> database: the plan switches become the ijara_plans list, and only switched-on plans keep a down payment. */
    public static function ijaraDataForSave(array $data): array
    {
        $rates = (array) ($data['ijara_rates'] ?? []);
        $plans = [];
        $clean = [];

        foreach ($rates as $slug => $row) {
            if (! empty($row['enabled'])) {
                $plans[] = $slug;
                $clean[$slug] = ['down' => $row['down'] ?? null];
            }
        }

        $data['ijara_plans'] = $plans;
        $data['ijara_rates'] = $clean;

        return $data;
    }

    /** Database -> form state: switch on every plan the bike is offered on. */
    public static function ijaraDataForForm(array $data): array
    {
        $plans = (array) ($data['ijara_plans'] ?? []);
        $rates = (array) ($data['ijara_rates'] ?? []);

        foreach (IjaraPlan::query()->pluck('slug') as $slug) {
            $rates[$slug]['enabled'] = in_array($slug, $plans, true);
        }

        $data['ijara_rates'] = $rates;

        return $data;
    }

    /** True when the bike is on Ijara but no plan is switched on. */
    public static function ijaraMissingPlan(array $data): bool
    {
        if (empty($data['ijara_enabled'])) {
            return false;
        }

        return collect((array) ($data['ijara_rates'] ?? []))->doesntContain(fn ($row) => ! empty($row['enabled']));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category')->searchable(),
                TextColumn::make('colors')
                    ->label('Colors')
                    ->getStateUsing(function (Motorcycle $record): \Illuminate\Support\HtmlString {
                        $variants = $record->colorVariants;

                        if ($variants->isEmpty()) {
                            return new \Illuminate\Support\HtmlString('<span style="color:#9ca3af;">-</span>');
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
                ToggleColumn::make('is_published')
                    ->label('Published')
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('ijara_enabled')
                    ->label('Ijara'),
                ToggleColumn::make('is_top_selling')
                    ->label('Top selling')
                    ->sortable(),
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
