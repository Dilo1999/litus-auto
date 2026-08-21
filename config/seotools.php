<?php

/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),
    'meta' => [
        'defaults' => [
            'title' => 'LITUS Automobiles',
            'titleBefore' => false,
            'description' => 'Honda and Yamaha scooters, genuine parts and expert service across five showrooms in the Maldives.',
            'separator' => ' - ',
            'keywords' => ['LITUS', 'motorcycles', 'scooters', 'Maldives', 'Ijara', 'Honda', 'Yamaha'],
            'canonical' => 'current',
            'robots' => 'index,follow',
        ],
        'webmaster_tags' => [
            'google' => null,
            'bing' => null,
            'alexa' => null,
            'pinterest' => null,
            'yandex' => null,
            'norton' => null,
        ],
        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        'defaults' => [
            'title' => 'LITUS Automobiles',
            'description' => 'Motorcycles, scooters and Ijara ownership plans in the Maldives.',
            'url' => null,
            'type' => 'website',
            'site_name' => 'LITUS Automobiles',
            'images' => [],
        ],
    ],
    'twitter' => [
        'defaults' => [
            'card' => 'summary_large_image',
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title' => 'LITUS Automobiles',
            'description' => 'Motorcycles, scooters and Ijara ownership plans in the Maldives.',
            'url' => 'current',
            'type' => 'WebPage',
            'images' => [],
        ],
    ],
];
