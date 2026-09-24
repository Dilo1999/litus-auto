<?php

namespace App\Support;

use App\Models\Motorcycle;

class IjaraRates
{
    /**
     * Calculator payload: only models with at least one approved rate,
     * containing only approved terms.
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
                        if (in_array((int) $term, $planTerms[$planKey], true)
                            && isset($rate['advance'], $rate['monthly'])) {
                            $terms[(int) $term] = [
                                'advance' => $rate['advance'],
                                'monthly' => $rate['monthly'],
                            ];
                        }
                    }

                    // A plan selected for this bike is always listed; rates may still be missing for some terms.
                    ksort($terms);
                    $modelPlans[$planKey] = (object) $terms;
                }

                // Models without approved rates are still listed; no result is shown for them.
                $models[] = ['key' => $motorcycle->slug, 'name' => $motorcycle->name, 'plans' => $modelPlans];
            });

        return [
            'plans' => $plans,
            'planTerms' => $planTerms,
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
