<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Inquiry extends Model
{
    public const TYPE_SALES = 'sales';

    public const TYPE_PARTS = 'parts';

    public const TYPE_SERVICE = 'service';

    public const TYPE_OTHER = 'other';

    /** Types shown on the dashboard chart, in chart order. */
    public const CHART_TYPES = [
        self::TYPE_SALES => 'Sales',
        self::TYPE_PARTS => 'Parts',
        self::TYPE_SERVICE => 'Service',
    ];

    /** Contact-form "inquiry type" options mapped to a chart type. */
    public const CONTACT_TYPE_MAP = [
        'Buying a motorcycle' => self::TYPE_SALES,
        'Ijara ownership plan' => self::TYPE_SALES,
        'A current promotion' => self::TYPE_SALES,
        'Parts' => self::TYPE_PARTS,
        'Service booking' => self::TYPE_SERVICE,
    ];

    protected $fillable = ['type', 'source'];

    /**
     * Log a submission. Never throws — a tracking failure must not break the form.
     */
    public static function record(string $type, string $source): void
    {
        try {
            static::create(['type' => $type, 'source' => $source]);
        } catch (\Throwable $e) {
            Log::warning('Could not record inquiry.', ['type' => $type, 'source' => $source, 'error' => $e->getMessage()]);
        }
    }

    public static function typeForContact(?string $inquiryType): string
    {
        return self::CONTACT_TYPE_MAP[$inquiryType] ?? self::TYPE_OTHER;
    }
}
