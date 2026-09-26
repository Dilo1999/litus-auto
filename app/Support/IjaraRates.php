<?php

namespace App\Support;

use App\Models\Motorcycle;

class IjaraRates
{
    /**
     * Approved figures for one bike on one plan.
     *
     * Entered on the motorcycle's admin page (down payment per plan, monthly lease per month count);
     * anything missing there falls back to config/ijara_rates.php. Values are used exactly as entered.
     *
     * @param  list<int>  $terms  months offered by the plan
     * @return array{down: int|float|null, rates: array<int, array{down: int|float|null, monthly: int|float}>}
     */
    public static function planRates(Motorcycle $motorcycle, string $planKey, array $terms): array
    {
        $stored = $motorcycle->ijara_rates[$planKey] ?? [];
        $config = config("ijara_rates.models.{$motorcycle->slug}.plans.{$planKey}", []);

        $configDowns = collect($config)->pluck('advance')->filter(fn ($v) => is_numeric($v));
        $storedDown = is_numeric($stored['down'] ?? null) ? $stored['down'] + 0 : null;
        $planDown = $storedDown ?? ($configDowns->isNotEmpty() ? $configDowns->min() : null);

        $rates = [];

        foreach ($terms as $term) {
            $monthly = $stored['months'][$term] ?? $config[$term]['monthly'] ?? null;

            if (! is_numeric($monthly)) {
                continue;
            }

            $rates[$term] = [
                'down' => $storedDown ?? ($config[$term]['advance'] ?? $planDown),
                'monthly' => $monthly + 0,
            ];
        }

        return ['down' => $planDown, 'rates' => $rates];
    }

    /**
     * Calculator payload: every published model that is on Ijara, the plans it is offered on, and for each
     * plan the down payment and the monthly lease per month count.
     */
    public static function calculatorData(): array
    {
        $plans = IjaraPlans::calculatorPlans();
        $planTerms = collect($plans)->mapWithKeys(fn ($name, $key) => [$key => IjaraPlans::termsFor($key)])->all();
        $models = [];

        Motorcycle::query()->where('is_published', true)->where('ijara_enabled', true)->orderBy('name')->get()
            ->each(function (Motorcycle $motorcycle) use (&$models, $plans, $planTerms) {
                $modelPlans = [];

                foreach ($plans as $planKey => $planName) {
                    if (! in_array($planKey, $motorcycle->ijara_plans ?? [], true)) {
                        continue;
                    }

                    $found = self::planRates($motorcycle, $planKey, $planTerms[$planKey]);

                    // A plan offered on this bike is always listed, even before its figures are entered.
                    $modelPlans[$planKey] = ['down' => $found['down'], 'rates' => (object) $found['rates']];
                }

                $hasPromo = $motorcycle->hasPromotion() && $motorcycle->discountAmount() > 0;
                $price = $hasPromo ? $motorcycle->promotionalSalePrice() : (float) $motorcycle->original_price;

                $models[] = [
                    'key' => $motorcycle->slug,
                    'name' => $motorcycle->name,
                    'image' => $motorcycle->cardImageUrl(),
                    'price' => $price > 0 ? (int) round($price) : null,
                    'plans' => $modelPlans,
                ];
            });

        return [
            'plans' => $plans,
            'planTerms' => $planTerms,
            'planTags' => collect(IjaraPlans::all())->pluck('tag', 'id')->all(),
            'models' => $models,
        ];
    }

    /**
     * Missing figures for bikes that are on Ijara, for the pre-launch audit.
     *
     * @return list<string>
     */
    public static function gaps(): array
    {
        $gaps = [];

        Motorcycle::query()->where('is_published', true)->where('ijara_enabled', true)->orderBy('name')->get()
            ->each(function (Motorcycle $motorcycle) use (&$gaps) {
                foreach (IjaraPlans::calculatorPlans() as $planKey => $planName) {
                    if (! in_array($planKey, $motorcycle->ijara_plans ?? [], true)) {
                        continue;
                    }

                    $terms = IjaraPlans::termsFor($planKey);
                    $found = self::planRates($motorcycle, $planKey, $terms);

                    if ($found['down'] === null) {
                        $gaps[] = "{$motorcycle->name} / {$planName}: no down payment";
                    }

                    foreach ($terms as $term) {
                        if (! isset($found['rates'][$term])) {
                            $gaps[] = "{$motorcycle->name} / {$planName} / {$term} months: no monthly lease (shows 'to be confirmed')";
                        }
                    }
                }
            });

        return $gaps;
    }
}
