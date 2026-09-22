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

        return $user instanceof User && $user->canAccessFilament();
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
                            ->helperText(fn (?PageSetting $record) => static::heroImageGuidance($record?->route_name, 'desktop')),
                        FileUpload::make('hero_image_mobile')
                            ->label('Mobile hero image')
                            ->image()
                            ->directory('heroes/mobile')
                            ->disk('public')
                            ->maxSize(4096)
                            ->helperText(fn (?PageSetting $record) => static::heroImageGuidance($record?->route_name, 'mobile')),
                    ])
                    ->columns(2),
            ]);
    }

    /**
     * Real, measured sizing guidance per page — this hero section's height is set by its
     * text/padding (not a fixed box), so there's no single "correct" pixel size across pages.
     * These recommendations reflect each page's actual layout (crop mode, focal point, and
     * whether its height is fixed or content-driven) taken from the page's own Blade template.
     */
    protected static function heroImageGuidance(?string $routeName, string $variant): string
    {
        $copy = [
            'home' => [
                'desktop' => 'Height grows with page content (no fixed box). Full-width banner; image is anchored center-right — left side is covered by a dark gradient + the headline text. Use a wide landscape photo, at least 1920×800px, with the main subject sitting in the right two-thirds.',
                'mobile' => 'Fixed-height band: roughly 240–380px tall. Focal point is centered, ~42% down from the top. Use a landscape photo at least 1200×500px.',
            ],
            'about' => [
                'desktop' => 'Height grows with page content (no fixed box). Full-width banner; focal point is centered, ~22% down from the top. Use a wide landscape photo at least 1920×700px, keeping the key subject near the top-center.',
                'mobile' => 'Height grows with page content. Focal point is centered, ~14% down from the top. Use a landscape photo at least 1200×500px, subject near the top.',
            ],
            'motorcycles' => [
                'desktop' => 'Height grows with page content (has the tallest padding of any hero on the site). Full-width banner; image is anchored center-right — left side is covered by dark gradient + text. Use a wide landscape photo at least 1920×900px.',
                'mobile' => 'Height grows with page content. Focal point is centered, ~30% down from the top. Use a landscape photo at least 1200×550px.',
            ],
            'ownership-plans' => [
                'desktop' => 'Height grows with page content (no fixed box). Full-width banner; image is anchored center-right — left side is covered by dark gradient + text. Use a wide landscape photo at least 1920×800px, subject in the right two-thirds.',
                'mobile' => 'Height grows with page content. Focal point is ~90% toward the right, ~70% down. Use a landscape photo at least 1200×500px with the subject toward the bottom-right.',
            ],
            'parts' => [
                'desktop' => 'Height grows with page content (no fixed box). Full-width banner; image is anchored center-right — left side is covered by dark gradient + text. Use a wide landscape photo at least 1920×800px.',
                'mobile' => 'Height grows with page content. Focal point is centered, ~30% down from the top. Use a landscape photo at least 1200×500px.',
            ],
            'service-center' => [
                'desktop' => 'Height grows with page content (no fixed box). Full-width banner; image is anchored center-right — left side is covered by dark gradient + text. Use a wide landscape photo at least 1920×800px.',
                'mobile' => 'Height grows with page content. Focal point is centered, ~30% down from the top. Use a landscape photo at least 1200×500px.',
            ],
            'contact' => [
                'desktop' => 'Different treatment from other pages: this image is NOT cropped full-bleed — it sits inside a right-hand panel (~52–58% of the page width) and is shown in full (scaled ~1.22×, bottom-anchored), so use a cutout-style portrait image, at least 1000×1300px, ideally on a transparent background.',
                'mobile' => 'Shown faded (35% opacity) as a background watermark behind the text, not as the main visual — full width, height grows with content, focal point ~30% down from the top. A simple landscape photo at least 1200×600px is enough; fine detail won\'t read well at this opacity.',
            ],
            'gallery' => [
                'desktop' => 'Fixed minimum height of 680px on screens 1100px and wider (below that it shrinks to fit content). Full-width banner, image anchored center-right. Use a wide landscape photo at least 1920×680px.',
                'mobile' => 'Shown faded (35% opacity) as a background watermark behind the text, not as the main visual. Height grows with content, focal point ~30% down from the top. A landscape photo at least 1200×500px is enough.',
            ],
        ];

        $fallback = $variant === 'desktop'
            ? 'Shown on desktop and tablet landscape (min-width 961px). Wide landscape image recommended, at least 1920×800px.'
            : 'Shown on mobile and small tablets. Landscape image recommended, at least 1200×500px.';

        return $copy[$routeName][$variant] ?? $fallback;
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
