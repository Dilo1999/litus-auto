<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageSeoResource\Pages;
use App\Models\PageSeo;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class PageSeoResource extends Resource
{
    protected static ?string $model = PageSeo::class;

    protected static ?string $navigationIcon = 'heroicon-o-search-circle';

    protected static ?string $navigationGroup = 'Super Settings';

    protected static ?int $navigationSort = 80;

    protected static ?string $navigationLabel = 'Page SEO';

    protected static ?string $modelLabel = 'Page SEO';

    protected static ?string $pluralModelLabel = 'Page SEO';

    protected static ?string $slug = 'page-seo';

    public static function canViewAny(): bool
    {
        $user = Auth::user();

        return $user instanceof User && $user->isSuperAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page')
                    ->schema([
                        Placeholder::make('page_label')
                            ->label('Page')
                            ->content(fn (?PageSeo $record) => $record?->page_label ?? '—'),
                        Placeholder::make('route_name')
                            ->label('Route')
                            ->content(fn (?PageSeo $record) => $record?->route_name ?? '—'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Search engine tags')
                    ->description('These values appear in Google search results and browser tabs.')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta title')
                            ->maxLength(70)
                            ->helperText('Aim for 50–60 characters. Use {name} on the motorcycle detail template.'),
                        Textarea::make('meta_description')
                            ->label('Meta description')
                            ->rows(3)
                            ->maxLength(160)
                            ->helperText('Aim for 140–160 characters.'),
                        Select::make('robots')
                            ->label('Search indexing')
                            ->options([
                                PageSeo::ROBOTS_INDEX => 'Index (show in search results)',
                                PageSeo::ROBOTS_NOINDEX => 'No index (hide from search results)',
                            ])
                            ->required(),
                    ]),

                Forms\Components\Section::make('Social sharing image')
                    ->description('Used when this page is shared on Facebook, WhatsApp, LinkedIn and similar platforms.')
                    ->schema([
                        FileUpload::make('og_image')
                            ->label('Share image (Open Graph)')
                            ->image()
                            ->directory('seo')
                            ->disk('public')
                            ->maxSize(2048)
                            ->helperText(fn (?PageSeo $record) => $record?->route_name === 'home'
                                ? 'Recommended for the home page. Use 1200×630 px if possible. Other pages fall back to this when left empty.'
                                : 'Optional. Leave empty to use the home page share image or the site default.'),
                    ]),
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
                TextColumn::make('meta_title')
                    ->label('Meta title')
                    ->limit(50)
                    ->toggleable(),
                TextColumn::make('robots')
                    ->label('Indexing')
                    ->formatStateUsing(fn (string $state) => str_starts_with($state, 'noindex') ? 'Hidden' : 'Indexed'),
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
            'index' => Pages\ListPageSeo::route('/'),
            'edit' => Pages\EditPageSeo::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
