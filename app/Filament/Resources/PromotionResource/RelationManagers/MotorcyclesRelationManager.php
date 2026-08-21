<?php

namespace App\Filament\Resources\PromotionResource\RelationManagers;

use App\Models\Motorcycle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\TextColumn;

class MotorcyclesRelationManager extends RelationManager
{
    protected static string $relationship = 'motorcycles';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $title = 'Products';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('brand')
                    ->sortable(),
                TextColumn::make('original_price')
                    ->label('Original')
                    ->formatStateUsing(fn ($state) => 'MVR '.number_format((float) $state, 2))
                    ->sortable(),
                TextColumn::make('sale_price')
                    ->label('Sale price')
                    ->getStateUsing(fn (Motorcycle $record) => $record->pivot->sale_price ?? null)
                    ->formatStateUsing(fn ($state) => $state === null ? '-' : 'MVR '.number_format((float) $state, 2)),
                TextColumn::make('saving')
                    ->label('Saving')
                    ->getStateUsing(function (Motorcycle $record): string {
                        $sale = (float) ($record->pivot->sale_price ?? 0);
                        $save = max(0, (float) $record->original_price - $sale);

                        return 'MVR '.number_format($save, 0);
                    }),
                TextColumn::make('offer_note')
                    ->label('Offer note')
                    ->getStateUsing(fn (Motorcycle $record) => $record->pivot->offer_note)
                    ->limit(40)
                    ->placeholder('—')
                    ->toggleable(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Add product')
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->label('Motorcycle')
                            ->helperText('Select a motorcycle to include in this promotion.'),
                        TextInput::make('sale_price')
                            ->label('Sale price')
                            ->numeric()
                            ->prefix('MVR')
                            ->step(0.01)
                            ->required(),
                        Textarea::make('offer_note')
                            ->label('Offer note')
                            ->rows(2)
                            ->maxLength(100)
                            ->helperText('Shown on this motorcycle\'s detail page. Max 100 characters.'),
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('editSalePrice')
                    ->label('Edit product')
                    ->icon('heroicon-o-pencil')
                    ->form([
                        TextInput::make('sale_price')
                            ->label('Sale price')
                            ->numeric()
                            ->prefix('MVR')
                            ->step(0.01)
                            ->required(),
                        Textarea::make('offer_note')
                            ->label('Offer note')
                            ->rows(2)
                            ->maxLength(100)
                            ->helperText('Shown on this motorcycle\'s detail page. Max 100 characters.'),
                    ])
                    ->mountUsing(function (Tables\Actions\Action $action, ?\Filament\Forms\ComponentContainer $form = null): void {
                        /** @var Motorcycle|null $record */
                        $record = $action->getRecord();

                        $form?->fill([
                            'sale_price' => $record?->pivot?->sale_price,
                            'offer_note' => $record?->pivot?->offer_note,
                        ]);
                    })
                    ->action(function (Motorcycle $record, array $data, RelationManager $livewire): void {
                        $livewire->getOwnerRecord()->motorcycles()->updateExistingPivot($record->id, [
                            'sale_price' => $data['sale_price'],
                            'offer_note' => filled($data['offer_note'] ?? null)
                                ? mb_substr((string) $data['offer_note'], 0, 100)
                                : null,
                        ]);
                    }),
                Tables\Actions\DetachAction::make()
                    ->label('Remove'),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
