<?php

namespace App\Http\GameEvents;

class GainEnergy extends Event
{
    public function parseData()
    {
        return [
            'name' => $this->name,
            'amount' => $this->params['amount'],
            'target' => $this->params['target'],
            'animation' => [
                'name' => 'gain-energy',
                'duration' => 1000,
            ]
        ];
    }
}
