<?php

return [
    // Triggers
    'enterField' => 'When this dude enters the field, ',
    'leaveField' => 'When this dude leaves the field, ',

    'anyDudeEnterField' => 'Whenever a player plays a dude, ',
    'selfDudeEnterField' => 'Whenever you play a dude, ',
    'opponentDudeEnterField' => 'Whenever your opponnent plays a dude, ',

    'anyDudeDeath' => 'Whenever another dude dies, ',
    'selfDudeDeath' => 'Whenever another dude you control dies, ',
    'opponentDudeDeath' => 'Whenever a dude your opponent controls dies, ',

    // Events
    'dealDamage' => [
        'any' => 'deal %amount damage to any target',
        'dude' => 'deal %amount damage to a dude',
        'self' => 'this loses %amount power',
        'player' => 'you lose %amount life',
        'opponent' => 'your opponent loses %amount life',
    ],

    'heal' => [
        'any' => 'heal any target for %amount',
        'dude' => 'heal a dude for %amount'
    ],

    'kill' => [
        'self' => 'this kills itself',
        'dude' => 'this kills a target dude'
    ],
];
