<?php

/*
| Approved Ijara rate data (source: rate appendix).
|
| Values are stored exactly as approved — never calculate or round them.
| Add one entry per motorcycle, keyed by the motorcycle slug (models come from the Motorcycles table,
| plans from the Ijara Plans page; plan keys: prime, family, secure, flexi, freedom).
| For each plan and month count give the approved down payment ('advance') and monthly lease ('monthly'):
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
| Only months ticked for the plan (Admin > Catalog > Ijara Plans) can be selected. A month with no entry
| here shows "rate not yet available" in the calculator.
| Run `php artisan ijara:audit` to list gaps before launch.
*/

return [
    'terms' => [6, 12, 24, 36, 48],

    'models' => [
        // Appendix data to be loaded here.
    ],
];
