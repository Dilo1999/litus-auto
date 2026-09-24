<?php

namespace App\Support;

use App\Models\Motorcycle;

class IjaraRates
{
    /**
     * Calculator payload: every published model that is on Ijara, with its current
     * price (promotional price when a promotion is active) and the plans it is offered on.
     * Monthly payments are computed in the browser from price, advance, term and the lease rate.
     */
    public static function calculatorData(): array
    {
        $plans = IjaraPlans::calculatorPlans();
        $planTerms = collect($plans)->mapWithKeys(fn ($name, $key) => [$key => IjaraPlans::termsFor($key)])->all();
        $models = [];

        Motorcycle::query()->where('is_published', true)->where('ijara_enabled', true)->orderBy('name')->get()
            ->each(function (Motorcycle $motorcycle) use (&$models, $plans) {
                $hasPromo = $motorcycle->hasPromotion() && $motorcycle->discountAmount() > 0;
                $price = $hasPromo ? $motorcycle->promotionalSalePrice() : (float) $motorcycle->original_price;

                if ($price <= 0) {
                    return;
                }

                $models[] = [
                    'key' => $motorcycle->slug,
                    'name' => $motorcycle->name,
                    'image' => $motorcycle->cardImageUrl(),
                    'price' => (int) round($price),
                    'plans' => array_values(array_filter(array_keys($plans), fn ($key) => in_array($key, $motorcycle->ijara_plans ?? [], true))),
                ];
            });

        return [
            'plans' => $plans,
            'planTerms' => $planTerms,
            'planTags' => collect(IjaraPlans::all())->pluck('tag', 'id')->all(),
            'rate' => config('ijara_rates.rate'),
            'models' => $models,
        ];
    }

    /**
     * Missing model / plan / term combinations, for the pre-launch audit.
     *
     * @return list<string>
     */
    public static function gaps(): array
    {
        $gaps = [];
        $rates = config('ijara_rates.models');

        Motorcycle::query()->where('is_published', true)->where('ijara_enabled', true)->orderBy('name')->get()
            ->each(function (Motorcycle $motorcycle) use (&$gaps, $rates) {
                if (! isset($rates[$motorcycle->slug])) {
                    $gaps[] = "{$motorcycle->name} [{$motorcycle->slug}]: no rate data at all";
                }
            });

        $bikes = Motorcycle::query()->where('ijara_enabled', true)->get()->keyBy('slug');

        foreach ($rates as $slug => $model) {
            if (! $bikes->has($slug)) {
                continue;
            }

            foreach (IjaraPlans::calculatorPlans() as $planKey => $planName) {
                if (! in_array($planKey, $bikes[$slug]->ijara_plans ?? [], true)) {
                    continue;
                }
                foreach (IjaraPlans::termsFor($planKey) as $term) {
                    if (! isset($model['plans'][$planKey][$term]['advance'], $model['plans'][$planKey][$term]['monthly'])) {
                        $gaps[] = "{$slug} / {$planName} / {$term} months: missing (not selectable until supplied)";
                    }
                }
            }
        }

        return $gaps;
    }
}
