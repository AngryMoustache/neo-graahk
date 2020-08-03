<?php

namespace App\Http\GameEvents;

class DrawCards extends Event
{
    public function parseData()
    {
        return [
            'name' => $this->name,
            'amount' => $this->params['amount'],
            'target' => $this->params['target'],
            'animation' => [
                'duration' => 1,
            ]
        ];
    }
}
