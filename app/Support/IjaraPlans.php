<?php

namespace App\Support;

use App\Models\IjaraPlan;

class IjaraPlans
{
    /** Repayment terms (months) an admin can enable per plan. */
    public const TERM_OPTIONS = [3, 6, 9, 12, 15, 18, 21, 24, 27, 30, 33, 36, 39, 42, 45, 48];

    /**
     * Published plans for the website: managed in the admin panel (Ijara Plans),
     * falling back to the built-in defaults until the table exists and is populated.
     */
    public static function all(): array
    {
        if (IjaraPlan::tableExists()) {
            try {
                $plans = IjaraPlan::published();

                if ($plans->isNotEmpty()) {
                    return $plans->map(fn (IjaraPlan $plan) => $plan->toPageArray())->all();
                }
            } catch (\Throwable) {
                // fall through to defaults
            }
        }

        return array_map(fn (array $plan) => $plan + [
            'terms' => $plan['id'] === 'premium' ? [6, 12] : [6, 12, 24, 36, 48],
            'calculator' => $plan['id'] !== 'premium',
        ], self::defaults());
    }

    /** Built-in plan content, used to seed the database and as a fallback. */
    public static function defaults(): array
    {
    return [
        [
            'id' => 'prime',
            'name' => 'Prime',
            'tag' => 'Lowest advance',
            'color' => '#C2650B',
            'bg' => '#FFF3E4',
            'accent' => '#C2650B',
            'accentLight' => '#FFF3E4',
            'icon' => 'star',
            'desc' => 'For customers who can provide supporting documents or have a previous ownership history with us.',
            'pts' => ['Lowest advance requirement', 'Fast approval pathway', 'Flexible early settlement'],
            'best' => 'Customers with LITUS history',
            'drawer' => [
                'subtitle' => 'Lowest Advance Payment',
                'fullDesc' => 'Prime Plan is designed for customers seeking the lowest possible advance payment while benefiting from our most competitive ownership structure.',
                'benefits' => ['Lowest advance payment requirement', 'Faster approval process', 'Flexible early settlement option', 'Ideal for customers with strong repayment credentials'],
                'eligibility' => 'Applicants may provide either a 6-month bank statement or a positive Ijara repayment history with LITUS Automobiles. An immediate family guarantor is also required.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy', '6-month bank statement or qualifying Ijara repayment history', 'Supporting document confirming immediate family relationship, if required'],
                'whoFor' => 'Customers looking for the lowest advance payment option, access to flexible early settlement, and who can provide additional supporting credentials.',
            ],
        ],
        [
            'id' => 'family',
            'name' => 'Family',
            'tag' => 'Family guarantor',
            'color' => '#1257D6',
            'bg' => '#DCE8FF',
            'accent' => '#1257D6',
            'accentLight' => '#DCE8FF',
            'icon' => 'users',
            'desc' => 'A practical route for customers supported by an immediate family guarantor.',
            'pts' => ['Lower upfront commitment', 'Simple qualification pathway', 'Flexible early settlement'],
            'best' => 'Family-supported buyers',
            'drawer' => [
                'subtitle' => 'Family Support Makes Ownership Easier',
                'fullDesc' => 'Family Plan is designed for customers who have built a positive Ijara repayment history with us and can be supported by an immediate family guarantor.',
                'benefits' => ['Lower advance payment requirement', 'Easier qualification pathway', 'Flexible early settlement option', 'Designed for returning customers'],
                'eligibility' => 'Applicants should have a positive Ijara repayment history with LITUS Automobiles. An immediate family guarantor is also required.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy', 'Qualifying Ijara repayment history with LITUS Automobiles', 'Supporting document confirming immediate family relationship, if required'],
                'whoFor' => 'Customers who have demonstrated responsible repayment behaviour with us and would like to benefit from lower upfront costs and flexible early settlement options.',
            ],
        ],
        [
            'id' => 'secure',
            'name' => 'Secure',
            'tag' => 'Employer guarantee',
            'color' => '#0E9384',
            'bg' => '#E6F6F3',
            'accent' => '#0E9384',
            'accentLight' => '#E6F6F3',
            'icon' => 'shield',
            'desc' => 'A balanced option for customers whose employer will act as guarantor.',
            'pts' => ['Reduced advance payment', 'Flexible ownership options', 'Flexible early settlement'],
            'best' => 'Employed customers',
            'drawer' => [
                'subtitle' => 'Lower Advance With An Employed Guarantor',
                'fullDesc' => 'Secure Plan offers a practical balance between affordability and accountability, making motorcycle ownership more accessible through the support of an employed guarantor.',
                'benefits' => ['Reduced advance payment requirement', 'Flexible early settlement option', 'Suitable for a wide range of customers', 'Straightforward qualification process'],
                'eligibility' => 'An employed guarantor is required. The guarantor should be employed for a minimum period of three months.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy', 'Guarantor employment letter confirming minimum employment period'],
                'whoFor' => 'Customers seeking a lower advance payment option and the flexibility of early settlement while being supported by an employed guarantor.',
            ],
        ],
        [
            'id' => 'flexi',
            'name' => 'Flexi',
            'tag' => 'For mixed incomes',
            'color' => '#6941C6',
            'bg' => '#F2ECFF',
            'accent' => '#6941C6',
            'accentLight' => '#F2ECFF',
            'icon' => 'zap',
            'desc' => 'Built for customers whose income comes from more than one source or varies month to month.',
            'pts' => ['Flexible guarantor option', 'Accessible approval pathway', 'Flexible early settlement'],
            'best' => 'Freelancers & fishermen',
            'drawer' => [
                'subtitle' => 'Designed For More Customers',
                'fullDesc' => 'Flexi Plan is designed to make ownership accessible to a wider range of customers, including freelancers, self-employed individuals, business owners, fishermen, contractors and customers with non-traditional income sources.',
                'benefits' => ['Flexible guarantor option', 'Flexible early settlement option', 'Accessible approval pathway', 'Designed for diverse income profiles'],
                'eligibility' => 'Customers can nominate a guarantor without strict employment or family relationship requirements.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy'],
                'whoFor' => 'Customers who may not meet the requirements of other plans but are looking for a practical ownership solution with greater flexibility and early settlement options.',
            ],
        ],
        [
            'id' => 'freedom',
            'name' => 'Freedom',
            'tag' => 'No guarantor',
            'color' => '#C4320A',
            'bg' => '#FFECE5',
            'accent' => '#C4320A',
            'accentLight' => '#FFECE5',
            'icon' => 'award',
            'desc' => 'For customers who prefer a simpler application process with greater independence.',
            'pts' => ['No guarantor required', 'Simpler approval process', 'Flexible early settlement'],
            'best' => 'Independent customers',
            'drawer' => [
                'subtitle' => 'Own Your Bike Without A Guarantor',
                'fullDesc' => 'Freedom Plan is designed for customers who prefer a simpler ownership process without the need for a guarantor.',
                'benefits' => ['No guarantor required', 'Simple application process', 'Faster ownership pathway', 'Greater independence and flexibility', 'Flexible early settlement option available'],
                'eligibility' => 'Freedom Plan requires a higher advance payment compared to other ownership plans, allowing customers to proceed without a guarantor.',
                'docs' => ['Applicant ID card copy', 'Two alternative family contact numbers'],
                'whoFor' => 'Customers who prefer a straightforward ownership process, value flexible early settlement, and can make a higher upfront contribution.',
            ],
        ],
        [
            'id' => 'premium',
            'name' => 'Premium',
            'tag' => 'Lowest total cost',
            'color' => '#0E9F6E',
            'bg' => '#E6F7F0',
            'accent' => '#0E9F6E',
            'accentLight' => '#E6F7F0',
            'icon' => 'clipboard-list',
            'desc' => 'Our shortest-term ownership route, designed for the lowest overall lease cost.',
            'pts' => ['Highest advance, shortest term', 'Lowest total lease amount', 'Fastest ownership completion'],
            'best' => 'Lowest cost & short term',
            'drawer' => [
                'subtitle' => 'Lower Total Payment. Faster Ownership.',
                'fullDesc' => 'Premium Plan is designed for customers who want to complete ownership sooner while benefiting from a lower overall payable amount compared to longer-term ownership plans.',
                'benefits' => ['Lower total payable amount', 'Faster ownership completion', 'Available in Premium 6, Premium 8 and Premium 12 options', 'Transparent fixed payment structure'],
                'eligibility' => 'Premium Plan is available with a flexible guarantor requirement and is designed for customers comfortable making a higher upfront contribution in exchange for lower overall ownership costs.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy'],
                'whoFor' => 'Customers who prefer shorter ownership periods, lower overall costs and a faster path to full ownership.',
                'important' => 'Unlike Prime, Family, Secure, Flexi and Freedom Plans, Premium Plans operate on a fixed ownership structure. Since the total ownership cost is already reduced and fixed at the start, flexible early settlement benefits are not applicable under Premium Plans.',
            ],
        ],
    ];
    }

    /** Plans that have calculator rate data (id => name). */
    public static function calculatorPlans(): array
    {
        return collect(self::all())
            ->where('calculator', true)
            ->mapWithKeys(fn (array $plan) => [$plan['id'] => $plan['name']])
            ->all();
    }

    /** Terms offered by one plan, or by any calculator plan when no id is given. */
    public static function termsFor(?string $planId = null): array
    {
        $plans = collect(self::all());
        $plans = $planId === null ? $plans->where('calculator', true) : $plans->where('id', $planId);

        return $plans->pluck('terms')->flatten()->map(fn ($t) => (int) $t)->unique()->sort()->values()->all();
    }

    /** Human range such as "6-48 months". */
    public static function termRange(): string
    {
        $terms = collect(self::all())->pluck('terms')->flatten()->map(fn ($t) => (int) $t)->unique()->sort()->values();

        if ($terms->isEmpty()) {
            return '';
        }

        return $terms->min() === $terms->max() ? $terms->min().' months' : $terms->min().'-'.$terms->max().' months';
    }

    /** Number of plans as a word, e.g. "six". */
    public static function countWord(): string
    {
        $words = [1 => 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];
        $count = count(self::all());

        return $words[$count] ?? (string) $count;
    }
}
