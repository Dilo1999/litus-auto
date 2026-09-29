<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IjaraPlanResource\Pages;
use App\Models\IjaraPlan;
use App\Support\IjaraPlans;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class IjaraPlanResource extends Resource
{
    protected static ?string $model = IjaraPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';

    protected static ?string $navigationGroup = 'Catalog';

    protected static ?int $navigationSort = 30;

    protected static ?string $navigationLabel = 'Ijara Plans';

    protected static ?string $modelLabel = 'Ijara Plan';

    protected static ?string $pluralModelLabel = 'Ijara Plans';

    protected static ?string $slug = 'ijara-plans';

    /** A list of plain strings edited as repeater rows. */
    protected static function listField(string $name, string $label, string $itemLabel, string $help = '', int $min = 1, int $max = 8): Repeater
    {
        return Repeater::make($name)
            ->label($label)
            ->schema([
                TextInput::make('value')->label($itemLabel)->required()->minLength(3)->maxLength(300),
            ])
            ->afterStateHydrated(function (Repeater $component, $state): void {
                $component->state(collect($state)
                    ->map(fn ($item) => is_array($item) ? $item : ['value' => (string) $item])
                    ->values()
                    ->all());
            })
            ->minItems($min)
            ->maxItems($max)
            ->required()
            ->createItemButtonLabel('Add '.Str::lower($itemLabel))
            ->helperText($help ?: null)
            ->columnSpanFull();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Plan card')
                    ->description('What customers see on the Ijara Plans page card.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->minLength(2)
                            ->maxLength(60)
                            ->unique(ignoreRecord: true)
                            ->placeholder('e.g. Prime')
                            ->reactive()
                            ->afterStateUpdated(function (\Closure $get, \Closure $set, ?string $state, string $context) {
                                if ($context === 'create' && blank($get('slug'))) {
                                    $set('slug', Str::slug((string) $state));
                                }
                            }),
                        TextInput::make('slug')
                            ->label('Plan key')
                            ->required()
                            ->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                            ->validationAttribute('plan key')
                            ->maxLength(60)
                            ->unique(ignoreRecord: true)
                            ->disabled(fn (string $context) => $context === 'edit')
                            ->helperText('Lowercase letters, numbers and hyphens only. Used to match rate data (config/ijara_rates.php); cannot be changed after the plan is created.'),
                        TextInput::make('tag')
                            ->label('Badge text')
                            ->required()
                            ->maxLength(30)
                            ->placeholder('e.g. Lowest advance'),
                        TextInput::make('best_for')
                            ->label('"Best for" line')
                            ->required()
                            ->maxLength(60)
                            ->placeholder('e.g. Customers with LITUS history'),
                        Textarea::make('description')
                            ->label('Short description')
                            ->required()
                            ->minLength(10)
                            ->rows(2)
                            ->maxLength(300)
                            ->columnSpanFull(),
                        static::listField('points', 'Card highlights', 'Highlight', 'Short bullet points shown with a tick on the card (3 works best, up to 5).', 1, 5),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Available months')
                    ->description('Plan A offers 6, 12 and 24 months. Plan B offers 36 and 48 months. In the payment calculator the customer picks Plan A or Plan B first and then sees only that option\'s months. Tick what this plan offers; leave Plan B empty if it offers neither 36 nor 48.')
                    ->schema([
                        CheckboxList::make('term_groups.0.months')
                            ->label('Plan A - months')
                            ->options(collect(IjaraPlans::PLAN_A_MONTHS)->mapWithKeys(fn (int $m) => [$m => "{$m} months"])->all())
                            ->columns(3)
                            ->required()
                            ->validationAttribute('Plan A months')
                            ->columnSpanFull(),
                        CheckboxList::make('term_groups.1.months')
                            ->label('Plan B - months (optional)')
                            ->options(collect(IjaraPlans::PLAN_B_MONTHS)->mapWithKeys(fn (int $m) => [$m => "{$m} months"])->all())
                            ->columns(3)
                            ->validationAttribute('Plan B months')
                            ->columnSpanFull(),
                        Toggle::make('show_in_calculator')
                            ->label('Include in the payment calculator')
                            ->helperText('Turn off for plans that have no rate data (for example Premium).')
                            ->default(true),
                    ]),

                Forms\Components\Section::make('Plan details pop-up')
                    ->description('Shown when a customer clicks View Details.')
                    ->schema([
                        TextInput::make('drawer_subtitle')
                            ->label('Subtitle')
                            ->required()
                            ->maxLength(160)
                            ->columnSpanFull(),
                        Textarea::make('full_description')
                            ->label('Full description')
                            ->required()
                            ->minLength(10)
                            ->maxLength(1000)
                            ->rows(3)
                            ->columnSpanFull(),
                        static::listField('benefits', 'Key benefits', 'Benefit'),
                        Textarea::make('eligibility')
                            ->required()
                            ->minLength(10)
                            ->maxLength(1000)
                            ->rows(3)
                            ->columnSpanFull(),
                        static::listField('documents', 'Required documents', 'Document'),
                        Textarea::make('who_for')
                            ->label('Who is it for?')
                            ->required()
                            ->minLength(10)
                            ->maxLength(1000)
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('important_note')
                            ->label('Important information (optional)')
                            ->maxLength(1000)
                            ->rows(3)
                            ->helperText('Shown in an orange notice box. Leave empty to hide it.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('tag')->label('Badge'),
                TextColumn::make('terms')
                    ->label('Months')
                    ->formatStateUsing(fn ($state, IjaraPlan $record) => collect($record->terms)->sort()->implode(', ')),
                BooleanColumn::make('show_in_calculator')->label('Calculator'),
                BooleanColumn::make('is_published')->label('Published'),
                TextColumn::make('updated_at')->label('Updated')->dateTime()->sortable(),
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
            'index' => Pages\ListIjaraPlans::route('/'),
            'create' => Pages\CreateIjaraPlan::route('/create'),
            'edit' => Pages\EditIjaraPlan::route('/{record}/edit'),
        ];
    }
}
