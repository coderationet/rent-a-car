<?php
return [

    // Strict Slider
    'strict_slider' => true,

    // Strict Attributes
    'strict_attributes' => true,

    'default_attributes' => [
        1, 2
    ],
    'filter_attributes' => [
        [
            "id" => 1,
            "is_open" => true,
        ],
        [
            "id" => 2,
            "is_open" => true,
        ]
    ],
    'allowed_image_sizes' =>[
        'big' => '790x400',
        'large' => '250x250',
        'small' => '190x120'
    ]
];
