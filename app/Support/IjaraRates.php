<?php

namespace App\Support;

use App\Models\Motorcycle;

class IjaraRates
{
    /**
     * Down payment (advance) for one bike on one plan: entered on the motorcycle's admin page,
     * with config/ijara_rates.php as a fallback. Returned exactly as entered.
     */
    public static function planDown(Motorcycle $motorcycle, string $planKey): int|float|null
    {
        $stored = $motorcycle->ijara_rates[$planKey]['down'] ?? null;

        if (is_numeric($stored)) {
            return $stored + 0;
        }

        $configDowns = collect(config("ijara_rates.models.{$motorcycle->slug}.plans.{$planKey}", []))
            ->pluck('advance')
            ->filter(fn ($v) => is_numeric($v));

        return $configDowns->isNotEmpty() ? $configDowns->min() + 0 : null;
    }

    /**
     * Calculator payload: every published model that is on Ijara with its current price (the promotional
     * price while a promotion is active) and, for each plan it is offered on, the down payment.
     *
     * The monthly payment is worked out in the browser:
     *   financial charge = (price - advance) x rate x months
     *   monthly payment  = (price - advance + financial charge) / months
     * where the rate (% per month) is set per plan and per option (Plan A / Plan B) in the admin panel.
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
                        $modelPlans[$planKey] = ['down' => self::planDown($motorcycle, $planKey)];
                    }
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

        Motorcycle::query()->where('is_published', true)->where('ijara_enabled', true)->orderBy('name')->get()
            ->each(function (Motorcycle $motorcycle) use (&$gaps) {
                if ((float) $motorcycle->original_price <= 0) {
                    $gaps[] = "{$motorcycle->name}: no price set";
                }

                foreach (IjaraPlans::calculatorPlans() as $planKey => $planName) {
                    if (in_array($planKey, $motorcycle->ijara_plans ?? [], true) && self::planDown($motorcycle, $planKey) === null) {
                        $gaps[] = "{$motorcycle->name} / {$planName}: no down payment";
                    }
                }
            });

        return $gaps;
    }
}
