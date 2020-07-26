<?php

return [
    // Triggers
    'triggers' => [
        'enterField',
        'leaveField',
        'anyDudeEnterField',
        'selfDudeEnterField',
        'opponentDudeEnterField',
        'anyDudeDeath',
        'selfDudeDeath',
        'opponentDudeDeath',
    ],

    // Events
    'events' => [
        'dealDamage' => [
            'amount' => '',
            'target' => [
                'any',
                'dude',
                'self',
                'player',
                'opponent'
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
                'all',
                'allButSelf',
                'allPlayer',
                'allButSelfPlayer',
                'allOpponent',
            ]
        ],
    ],
];
