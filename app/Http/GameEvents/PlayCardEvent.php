<?php

namespace App\Http\GameEvents;

class PlayCardEvent extends Event
{
    public function parseData()
    {
        return [
            'name' => $this->name,
            'params' => $this->params,
            'animation' => ['duration' => 1000]
        ];
    }
}
