<?php

namespace App\Filament\Resources\GalleryVideoResource\Pages;

use App\Filament\Resources\GalleryVideoResource;
use App\Models\GalleryVideo;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;

class EditGalleryVideo extends EditRecord
{
    protected static string $resource = GalleryVideoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (! GalleryVideo::extractTikTokVideoId($data['video_url'] ?? '')) {
            throw ValidationException::withMessages([
                'video_url' => 'Please enter a valid TikTok video URL.',
            ]);
        }

        return $data;
    }
}
