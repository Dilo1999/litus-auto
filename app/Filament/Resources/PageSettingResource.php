<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageSettingResource\Pages;
use App\Models\PageSetting;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class PageSettingResource extends Resource
{
    protected static ?string $model = PageSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-photograph';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 50;

    protected static ?string $navigationLabel = 'Page Settings';

    protected static ?string $modelLabel = 'Page Setting';

    protected static ?string $pluralModelLabel = 'Page Settings';

    protected static ?string $slug = 'page-settings';

    public static function canViewAny(): bool
    {
        $user = Auth::user();

        return $user instanceof User && $user->isSuperAdmin();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero images')
                    ->description('Background images for the page hero section. Upload separate images for desktop (961px and wider) and mobile.')
                    ->schema([
                        FileUpload::make('hero_image_desktop')
                            ->label('Desktop hero image')
                            ->image()
                            ->directory('heroes/desktop')
                            ->disk('public')
                            ->maxSize(4096)
                            ->helperText('Shown on desktop and tablet landscape (min-width 961px). Wide landscape image recommended.'),
                        FileUpload::make('hero_image_mobile')
                            ->label('Mobile hero image')
                            ->image()
                            ->directory('heroes/mobile')
                            ->disk('public')
                            ->maxSize(4096)
                            ->helperText('Shown on mobile and small tablets. Portrait or square crop works best.'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page_label')
                    ->label('Page')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('hero_image_desktop')
                    ->label('Hero images')
                    ->formatStateUsing(fn (?string $state, PageSetting $record) => filled($state) || filled($record->hero_image_mobile) ? 'Custom' : 'Default'),
            ])
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPageSettings::route('/'),
            'edit' => Pages\EditPageSetting::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
