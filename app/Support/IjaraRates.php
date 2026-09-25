<?php

namespace App\Support;

use App\Models\Motorcycle;

class IjaraRates
{
    /**
     * Calculator payload: every published model that is on Ijara, the plans it is offered on, and the
     * approved down payment and monthly lease for each plan / month combination (config/ijara_rates.php).
     * Figures are passed through exactly as approved - nothing is calculated or rounded.
     */
    public static function calculatorData(): array
    {
        $plans = IjaraPlans::calculatorPlans();
        $planTerms = collect($plans)->mapWithKeys(fn ($name, $key) => [$key => IjaraPlans::termsFor($key)])->all();
        $rates = config('ijara_rates.models');
        $models = [];

        Motorcycle::query()->where('is_published', true)->where('ijara_enabled', true)->orderBy('name')->get()
            ->each(function (Motorcycle $motorcycle) use (&$models, $plans, $planTerms, $rates) {
                $modelPlans = [];

                foreach ($plans as $planKey => $planName) {
                    if (! in_array($planKey, $motorcycle->ijara_plans ?? [], true)) {
                        continue;
                    }

                    $terms = [];

                    foreach ($rates[$motorcycle->slug]['plans'][$planKey] ?? [] as $term => $rate) {
                        if (in_array((int) $term, $planTerms[$planKey], true) && isset($rate['advance'], $rate['monthly'])) {
                            $terms[(int) $term] = ['down' => $rate['advance'], 'monthly' => $rate['monthly']];
                        }
                    }

                    ksort($terms);
                    // A plan offered on this bike is always listed; terms without an approved rate stay empty.
                    $modelPlans[$planKey] = (object) $terms;
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
