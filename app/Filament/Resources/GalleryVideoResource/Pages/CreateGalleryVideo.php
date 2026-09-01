<?php

namespace App\Filament\Resources\GalleryVideoResource\Pages;

use App\Filament\Resources\GalleryVideoResource;
use App\Models\GalleryVideo;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateGalleryVideo extends CreateRecord
{
    protected static string $resource = GalleryVideoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (! GalleryVideo::extractTikTokVideoId($data['video_url'] ?? '')) {
            throw ValidationException::withMessages([
                'video_url' => 'Please enter a valid TikTok video URL.',
            ]);
        }

        return $data;
    }
}
