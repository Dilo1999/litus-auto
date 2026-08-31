<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Customer Moments Visibility
    |--------------------------------------------------------------------------
    |
    | When false, the Customer Moments gallery section is hidden on the site
    | and the Filament admin menu entry is not shown. Data remains in the DB.
    |
    */

    'customer_moments_visible' => filter_var(
        env('GALLERY_CUSTOMER_MOMENTS_VISIBLE', false),
        FILTER_VALIDATE_BOOLEAN
    ),

];
