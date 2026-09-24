<?php

/*
| Approved Ijara rate data (source: rate appendix).
|
| Values are stored exactly as approved — never calculate or round them.
| Add one entry per motorcycle, keyed by the motorcycle slug (models come from the Motorcycles table,
| plans from the Ijara Plans page; plan keys: prime, family, secure, flexi, freedom):
|
|   'air-blade-125-special-edition' => [
|       'name' => 'Air Blade 125 Special Edition',
|       'plans' => [
|           'prime' => [
|               6  => ['advance' => 0, 'monthly' => 0],
|               12 => ['advance' => 0, 'monthly' => 0],
|           ],
|       ],
|   ],
|
| A term that is absent from a model/plan is not selectable in the calculator.
| Run `php artisan ijara:audit` to list gaps before launch.
*/

return [
    /*
    | Lease (profit) rate used by the payment calculator, applied to the amount left after the advance.
    | basis: 'year'  = percent per year, flat   -> financed x (1 + percent% x months/12)
    |        'month' = percent per month, flat  -> financed x (1 + percent% x months)
    |        'once'  = one-time percent          -> financed x (1 + percent%)
    */
    'rate' => ['percent' => 2.5, 'basis' => 'year'],

    'terms' => [6, 12, 24, 36, 48],

    'models' => [
        // Appendix data to be loaded here.
    ],
];
