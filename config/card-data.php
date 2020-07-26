<?php

return [
    // Triggers
    'triggers' => [
        'enterField',
        'leaveField',
    ],

    // Events
    'events' => [
        'dealDamage' => [
            'amount' => '',
            'target' => [
                'any',
                'dude'
            ]
        ],

        'heal' => [
            'amount' => '',
            'target' => [
                'any',
                'dude'
            ]
        ],

        'kill' => [
            'target' => [
                'dude',
                'self',
            ]
        ],
    ],
];
