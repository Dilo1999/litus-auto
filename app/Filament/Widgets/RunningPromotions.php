<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PromotionResource;
use App\Models\Promotion;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RunningPromotions extends TableWidget
{
    protected static ?int $sort = 40;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Running promotions';

    protected function getTableQuery(): Builder
    {
        return Promotion::query()
            ->published()
            ->currentlyActive()
            ->withCount('motorcycles')
            ->ordered();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('title')->label('Promotion')->weight('bold'),
            TextColumn::make('offer_note')->label('Offer')->limit(60),
            TextColumn::make('motorcycles_count')->label('Bikes')->alignCenter(),
            BadgeColumn::make('is_featured')
                ->label('Featured')
                ->formatStateUsing(fn ($state) => $state ? 'Featured' : '—')
                ->colors(['warning' => fn ($state) => (bool) $state]),
            TextColumn::make('ends_at')
                ->label('Ends')
                ->formatStateUsing(fn ($state, $record) => $record->ends_at
                    ? $record->ends_at->diffForHumans()
                    : 'No end date'),
        ];
    }

    protected function getTableRecordUrlUsing(): ?\Closure
    {
        return fn (Promotion $record): string => PromotionResource::getUrl('edit', ['record' => $record]);
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'No promotions are running right now';
    }
}
