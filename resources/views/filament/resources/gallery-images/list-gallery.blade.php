<x-filament::page
    :class="\Illuminate\Support\Arr::toCssClasses([
        'filament-resources-list-records-page',
        'filament-resources-' . str_replace('/', '-', $this->getResource()::getSlug()),
    ])"
>
    @php
        $records = $this->galleryRecords;
    @endphp

    <style>
        .gallery-admin-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.75rem;
        }

        @media (min-width: 768px) {
            .gallery-admin-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (min-width: 1280px) {
            .gallery-admin-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        .gallery-admin-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
            border-radius: 0.75rem;
            background: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .gallery-admin-image {
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #f3f4f6;
            flex-shrink: 0;
        }

        .gallery-admin-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-admin-actions {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.35rem;
            padding: 0.5rem;
            border-top: 1px solid #f3f4f6;
            margin-top: auto;
            flex-shrink: 0;
        }

        .gallery-admin-actions button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
            min-height: 2rem;
            padding: 0.35rem 0.4rem;
            border: 0;
            border-radius: 0.5rem;
            font-size: 0.7rem;
            font-weight: 600;
            line-height: 1;
            cursor: pointer;
            white-space: nowrap;
        }

        .gallery-admin-actions button svg {
            width: 0.85rem;
            height: 0.85rem;
            flex-shrink: 0;
        }

        .dark .gallery-admin-card {
            background: #1f2937;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .dark .gallery-admin-image {
            background: #111827;
        }

        .dark .gallery-admin-actions {
            border-top-color: rgba(255, 255, 255, 0.1);
        }
    </style>

    <div
        x-data
        x-on:click.document="
            if ($event.target.closest('[data-gallery-upload-trigger]')) {
                $event.preventDefault();
                $refs.galleryUpload.click();
            }
        "
        x-on:gallery-upload-reset.window="$refs.galleryUpload.value = ''"
    >
        <input
            type="file"
            id="gallery-direct-upload"
            x-ref="galleryUpload"
            class="sr-only"
            multiple
            accept="image/jpeg,image/png,image/webp,image/gif"
            wire:model="uploadImages"
        >
    </div>

    <div
        wire:loading.flex
        wire:target="uploadImages"
        class="fixed inset-0 z-50 items-center justify-center bg-gray-950/40"
    >
        <div class="rounded-lg bg-white px-6 py-4 text-sm font-medium text-gray-900 shadow-lg dark:bg-gray-800 dark:text-white">
            Uploading images…
        </div>
    </div>

    <div class="space-y-6">
        @if ($records->isEmpty())
            <div class="rounded-xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center dark:border-gray-700 dark:bg-gray-800">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                    No gallery images yet.
                </p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Use “Add gallery images” to upload multiple photos at once.
                </p>
            </div>
        @else
            <div class="gallery-admin-grid">
                @foreach ($records as $record)
                    <div class="gallery-admin-card">
                        <div class="gallery-admin-image">
                            <img src="{{ $record->imageUrl() }}"
                                 alt="Gallery image"
                                 loading="lazy">
                        </div>

                        <div class="gallery-admin-actions">
                            <button type="button"
                                    wire:click="toggleFeatured({{ $record->id }})"
                                    style="{{ $record->is_featured
                                        ? 'background-color:#f59e0b;color:#ffffff;'
                                        : 'background-color:#e5e7eb;color:#111827;' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span>{{ $record->is_featured ? 'Featured' : 'Feature' }}</span>
                            </button>

                            <button type="button"
                                    wire:click="togglePublished({{ $record->id }})"
                                    style="{{ $record->is_published
                                        ? 'background-color:#059669;color:#ffffff;'
                                        : 'background-color:#e5e7eb;color:#111827;' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ $record->is_published ? 'Published' : 'Draft' }}</span>
                            </button>

                            <button type="button"
                                    wire:click="deleteRecord({{ $record->id }})"
                                    onclick="return confirm('Delete this image?')"
                                    style="background-color:#e11d48;color:#ffffff;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span>Delete</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-filament::page>
