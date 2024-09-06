<?php

return [
    /*
     * ---------------------------------------------------------------
     * formatting
     * ---------------------------------------------------------------
     *
     * the formatting of shopping cart values
     */
    'format_numbers' => env('SHOPPING_FORMAT_VALUES', false),

    'decimals' => env('SHOPPING_DECIMALS', 0),

    'dec_point' => env('SHOPPING_DEC_POINT', '.'),

    'thousands_sep' => env('SHOPPING_THOUSANDS_SEP', ','),


    'product_details' => [
        '1' => [
            'id' => 1,
            'name' => 'LOIS CARON Watch',
            'price' => 500.00,
            'quantity' => 1,
            'attributes' => array()
        ],
        '2' => [
            'id' => 2,
            'name' => 'Digital Camera EOS',
            'price' => 600.00,
            'quantity' => 1,
            'attributes' => array()
        ],
        '3' => [
            'id' => 3,
            'name' => 'Lenovo Smartchoice Ideapad 3',
            'price' => 700.00,
            'quantity' => 1,
            'attributes' => array()
        ],
    ],
    /*
     * ---------------------------------------------------------------
     * persistence
     * ---------------------------------------------------------------
     *
     * the configuration for persisting cart
     */
    'storage' => null,

    /*
     * ---------------------------------------------------------------
     * events
     * ---------------------------------------------------------------
     *
     * the configuration for cart events
     */
    'events' => null,
];
