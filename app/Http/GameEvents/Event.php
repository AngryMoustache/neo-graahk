<?php

namespace App\Http\GameEvents;

use App\Http\Events\BoardUpdate;

class Event
{
    public $gameId;
    public $name;
    public $params;

    public function __construct($gameId, $name, $params)
    {
        $this->gameId = $gameId;
        $this->name = $name;
        $this->params = $params;
    }

    public function parseData()
    {
        return $this->params;
    }

    public function send()
    {
        event(new BoardUpdate($this->gameId, $this->parseData()));
    }
}
