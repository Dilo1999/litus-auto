<?php

namespace App\Support;

use App\Models\Motorcycle;

class IjaraRates
{
    /**
     * Down payment (advance) for one bike, on one plan and option (Plan A / Plan B): entered on the
     * motorcycle's admin page, with config/ijara_rates.php as a fallback. Returned exactly as entered.
     */
    public static function planDown(Motorcycle $motorcycle, string $planKey, string $option = 'a'): int|float|null
    {
        if (! self::optionEnabled($motorcycle, $planKey, $option)) {
            return null;
        }

        $row = $motorcycle->ijara_rates[$planKey] ?? [];
        // Plans saved before the Plan A / Plan B split kept a single "down" figure.
        $stored = $row["down_{$option}"] ?? $row['down'] ?? null;

        if (is_numeric($stored)) {
            return $stored + 0;
        }

        $configDowns = collect(config("ijara_rates.models.{$motorcycle->slug}.plans.{$planKey}", []))
            ->pluck('advance')
            ->filter(fn ($v) => is_numeric($v));

        return $configDowns->isNotEmpty() ? $configDowns->min() + 0 : null;
    }

    /** Whether this bike is offered on one option (Plan A / Plan B) of a plan; switched on unless the admin turned it off. */
    public static function optionEnabled(Motorcycle $motorcycle, string $planKey, string $option): bool
    {
        return (bool) ($motorcycle->ijara_rates[$planKey]["{$option}_enabled"] ?? true);
    }

    /**
     * Calculator payload: every published model that is on Ijara with its current price (the promotional
     * price while a promotion is active) and, for each plan it is offered on, the down payment.
     *
     * The monthly payment is worked out in the browser (resources/js/home.js):
     *   Plan A (any term): 2.5% is a MONTHLY rate on the amount remaining after the down payment.
     *     Remaining Amount   = Price - Advance
     *     Monthly Interest   = Remaining Amount x 0.025
     *     Total Interest     = Monthly Interest x Number of Months
     *     Total Lease Amount = Remaining Amount + Total Interest
     *     Monthly Lease      = Total Lease Amount / Number of Months
     *   Plan B (36 or 48 months only): also a MONTHLY 2.5% rate, but on the price after a flat MVR 4,000
     *   discount, with the advance deducted both before and after the finance charge is added.
     *     Actual Price After Discount = Price - MVR 4,000
     *     Financed Amount             = Actual Price After Discount - Advance
     *     Finance Charge              = Financed Amount x 0.025 x Number of Months
     *     Total Price                 = Actual Price After Discount + Finance Charge
     *     Balance                     = Total Price - Advance
     *     Monthly Payment             = Balance / Number of Months
     */
    public static function calculatorData(): array
    {
        $plans = IjaraPlans::calculatorPlans();
        $planTerms = collect($plans)->mapWithKeys(fn ($name, $key) => [$key => IjaraPlans::termsFor($key)])->all();
        $models = [];

        Motorcycle::query()->where('is_published', true)->where('ijara_enabled', true)->orderBy('name')->get()
            ->each(function (Motorcycle $motorcycle) use (&$models, $plans) {
                $modelPlans = [];

                foreach ($plans as $planKey => $planName) {
                    if (in_array($planKey, $motorcycle->ijara_plans ?? [], true)) {
                        // A plan offered on this bike is always listed, even before its down payment is entered.
                        // Down payment can differ between Plan A (6/12/24 months) and Plan B (36/48 months).
                        // Options the admin switched off for this bike are hidden in the calculator.
                        $modelPlans[$planKey] = [
                            'down_a' => self::planDown($motorcycle, $planKey, 'a'),
                            'down_b' => self::planDown($motorcycle, $planKey, 'b'),
                            'options' => [
                                'a' => self::optionEnabled($motorcycle, $planKey, 'a'),
                                'b' => self::optionEnabled($motorcycle, $planKey, 'b'),
                            ],
                        ];
                    }
                }

                // Ijara pricing always uses the original price, never a promotional sale price.
                $price = (float) $motorcycle->original_price;
                $engine = $motorcycle->engineCapacity();
                $transmission = $motorcycle->specValue('Transmission Type');

                $models[] = [
                    'key' => $motorcycle->slug,
                    'name' => $motorcycle->name,
                    'brand' => filled($motorcycle->brand) ? $motorcycle->brand : null,
                    'image' => $motorcycle->cardImageUrl(),
                    'price' => $price > 0 ? (int) round($price) : null,
                    'specs' => array_filter([
                        'engine' => is_numeric($engine) ? "{$engine} cc" : $engine,
                        'transmission' => $transmission ? trim(preg_replace('/\s*transmission$/i', '', $transmission)) : null,
                        'tank' => $motorcycle->fuelTankCapacity(),
                    ]),
                    'plans' => $modelPlans,
                ];
            });

        return [
            'plans' => $plans,
            'planTerms' => $planTerms,
            'groups' => [
                ['label' => 'Plan A', 'months' => IjaraPlans::PLAN_A_MONTHS],
                ['label' => 'Plan B', 'months' => IjaraPlans::PLAN_B_MONTHS],
            ],
            'planGroups' => collect(IjaraPlans::all())->mapWithKeys(fn ($plan) => [$plan['id'] => $plan['termGroups'] ?? []])->all(),
            'planTags' => collect(IjaraPlans::all())->pluck('tag', 'id')->all(),
            'models' => $models,
        ];
    }

    /**
     * Bikes that are on Ijara but cannot be calculated yet (no price or no down payment), for the pre-launch audit.
     *
     * @return list<string>
     */
    public static function gaps(): array
    {
        $gaps = [];
        // The option labels (Plan A / Plan B) each calculator plan actually offers, so a plan with only
        // Plan A isn't flagged for a missing Plan B down payment it will never need.
        $planOptions = collect(IjaraPlans::all())->mapWithKeys(fn (array $plan) => [
            $plan['id'] => collect($plan['termGroups'] ?? [])->pluck('label')->all() ?: ['Plan A'],
        ]);

        Motorcycle::query()->where('is_published', true)->where('ijara_enabled', true)->orderBy('name')->get()
            ->each(function (Motorcycle $motorcycle) use (&$gaps, $planOptions) {
                if ((float) $motorcycle->original_price <= 0) {
                    $gaps[] = "{$motorcycle->name}: no price set";
                }

                foreach (IjaraPlans::calculatorPlans() as $planKey => $planName) {
                    if (! in_array($planKey, $motorcycle->ijara_plans ?? [], true)) {
                        continue;
                    }

                    foreach ($planOptions->get($planKey, ['Plan A']) as $label) {
                        $option = $label === 'Plan B' ? 'b' : 'a';

                        if (self::optionEnabled($motorcycle, $planKey, $option) && self::planDown($motorcycle, $planKey, $option) === null) {
                            $gaps[] = "{$motorcycle->name} / {$planName} ({$label}): no down payment";
                        }
                    }
                }
            });

        return $gaps;
    }
}
