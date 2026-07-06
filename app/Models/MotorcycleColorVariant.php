<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MotorcycleColorVariant extends Model
{
    protected $fillable = [
        'motorcycle_id',
        'label',
        'hex_color',
        'spin_frames',
        'gallery_images',
        'is_default',
        'sort_order',
    ];

    protected $casts = [
        'spin_frames' => 'array',
        'gallery_images' => 'array',
        'is_default' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function motorcycle(): BelongsTo
    {
        return $this->belongsTo(Motorcycle::class);
    }

    public function spinFrameUrls(): array
    {
        return collect($this->spin_frames ?? [])
            ->map(fn ($path) => Motorcycle::resolveImageUrl($path))
            ->filter()
            ->values()
            ->all();
    }

    public function galleryImageUrls(): array
    {
        return collect($this->gallery_images ?? [])
            ->map(fn ($path) => Motorcycle::resolveImageUrl($path))
            ->filter()
            ->values()
            ->all();
    }
}
