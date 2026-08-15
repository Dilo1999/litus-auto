<?php

namespace App\Filament\Concerns;

use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Collection;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

trait ListsCategoryGalleryImages
{
    use WithFileUploads;

    /** @var array<int, TemporaryUploadedFile>|TemporaryUploadedFile|null */
    public $uploadImages = [];

    protected function getActions(): array
    {
        if (! static::getResource()::canCreate()) {
            return [];
        }

        return [
            Actions\Action::make('addGalleryImages')
                ->label('Add gallery images')
                ->button()
                ->url('#')
                ->extraAttributes([
                    'data-gallery-upload-trigger' => 'true',
                ]),
        ];
    }

    public function updatedUploadImages(): void
    {
        $resource = static::getResource();

        abort_unless($resource::canCreate(), 403);

        $files = collect(is_array($this->uploadImages) ? $this->uploadImages : [$this->uploadImages])
            ->filter(fn ($file) => $file instanceof TemporaryUploadedFile)
            ->values();

        if ($files->isEmpty()) {
            return;
        }

        try {
            $this->validate([
                'uploadImages' => ['required', 'array', 'min:1', 'max:40'],
                'uploadImages.*' => ['required', 'image', 'max:500'],
            ], [
                'uploadImages.*.max' => 'Each image must be 500KB or smaller.',
                'uploadImages.*.image' => 'Only image files are allowed.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $this->uploadImages = [];
            $this->dispatchBrowserEvent('gallery-upload-reset');

            Notification::make()
                ->title($exception->validator->errors()->first() ?: 'Upload failed')
                ->danger()
                ->send();

            return;
        }

        $category = $resource::getCategory();
        $directory = 'gallery/'.$category;

        $paths = $files->map(function (TemporaryUploadedFile $file) use ($directory) {
            return $file->store($directory, 'public');
        })->all();

        $resource::createGalleryRecords([
            'category' => $category,
            'images' => $paths,
            'is_featured' => false,
            'is_published' => true,
        ]);

        $this->uploadImages = [];
        $this->dispatchBrowserEvent('gallery-upload-reset');

        Notification::make()
            ->title('Images added')
            ->success()
            ->send();
    }

    public function getGalleryRecordsProperty(): Collection
    {
        return static::getResource()::getEloquentQuery()->get();
    }

    public function toggleFeatured(int $recordId): void
    {
        $record = static::getResource()::getEloquentQuery()->findOrFail($recordId);

        abort_unless(static::getResource()::canEdit($record), 403);

        $record->update([
            'is_featured' => ! $record->is_featured,
        ]);
    }

    public function togglePublished(int $recordId): void
    {
        $record = static::getResource()::getEloquentQuery()->findOrFail($recordId);

        abort_unless(static::getResource()::canEdit($record), 403);

        $record->update([
            'is_published' => ! $record->is_published,
        ]);
    }

    public function deleteRecord(int $recordId): void
    {
        $record = static::getResource()::getEloquentQuery()->findOrFail($recordId);

        abort_unless(static::getResource()::canDelete($record), 403);

        $record->delete();

        Notification::make()
            ->title('Image deleted')
            ->success()
            ->send();
    }
}
