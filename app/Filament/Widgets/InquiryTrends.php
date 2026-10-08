<?php

namespace App\Filament\Widgets;

use App\Models\Inquiry;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class InquiryTrends extends Widget
{
    protected static ?int $sort = 15;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.inquiry-trends';

    protected const MONTHS = 12;

    protected function getViewData(): array
    {
        $start = now()->startOfMonth()->subMonths(static::MONTHS - 1);

        $months = collect(range(0, static::MONTHS - 1))
            ->map(fn (int $i) => $start->copy()->addMonths($i));

        // Count per type per "Y-m" for the window.
        $counts = Inquiry::query()
            ->whereIn('type', array_keys(Inquiry::CHART_TYPES))
            ->where('created_at', '>=', $start)
            ->toBase()
            ->get(['type', 'created_at'])
            ->countBy(fn ($row) => $row->type.'|'.Carbon::parse($row->created_at)->format('Y-m'));

        // The current month is still running, so compare it with last month up to
        // the same day/time rather than with last month's full total.
        $samePointLastMonth = now()->subMonthNoOverflow();
        $previousToDate = Inquiry::query()
            ->whereIn('type', array_keys(Inquiry::CHART_TYPES))
            ->whereBetween('created_at', [$samePointLastMonth->copy()->startOfMonth(), $samePointLastMonth])
            ->toBase()
            ->selectRaw('type, COUNT(*) as aggregate')
            ->groupBy('type')
            ->pluck('aggregate', 'type');

        $series = collect(Inquiry::CHART_TYPES)->map(function (string $label, string $type) use ($months, $counts, $previousToDate) {
            $values = $months->map(fn (Carbon $m) => (int) ($counts[$type.'|'.$m->format('Y-m')] ?? 0))->all();
            $current = end($values);
            $previous = (int) ($previousToDate[$type] ?? 0);

            return [
                'key' => $type,
                'label' => $label,
                'values' => $values,
                'total' => array_sum($values),
                'current' => $current,
                'previous' => $previous,
                'delta' => $previous > 0 ? (int) round(($current - $previous) / $previous * 100) : null,
            ];
        })->values();

        $max = max(1, $series->flatMap(fn ($s) => $s['values'])->max());
        [$axisMax, $ticks] = $this->niceScale($max);

        return [
            'months' => $months->map(fn (Carbon $m) => [
                'short' => $m->format('M'),
                'long' => $m->format('F Y'),
                'isCurrent' => $m->isSameMonth(now()),
            ])->all(),
            'series' => $series,
            'axisMax' => $axisMax,
            'ticks' => $ticks,
            'grandTotal' => $series->sum('total'),
            'currentMonth' => now()->format('F'),
            'comparisonLabel' => 'vs '.now()->subMonthNoOverflow()->format('M').' 1–'.now()->subMonthNoOverflow()->format('j'),
        ];
    }

    /**
     * Round the axis up to a 1/2/5 step with four intervals (0, 5, 10, 15, 20...).
     *
     * @return array{0: int, 1: array<int, int>}
     */
    protected function niceScale(int $max): array
    {
        $raw = $max / 4;
        $magnitude = 10 ** floor(log10(max($raw, 1)));
        $step = collect([1, 2, 5, 10])->map(fn ($f) => $f * $magnitude)->first(fn ($s) => $s >= $raw);
        $step = max(1, (int) $step);

        $top = (int) (ceil($max / $step) * $step);

        return [$top, range(0, $top, $step)];
    }
}
