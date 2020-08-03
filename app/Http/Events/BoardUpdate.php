<?php

namespace App\Http\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class BoardUpdate implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $channel;

    public function __construct($gameId, $message)
    {
        $this->message = $message;
        $this->channel = "graahk-game-$gameId";
    }

    public function broadcastOn()
    {
        return [$this->channel];
    }

    public function broadcastAs()
    {
        return 'board-update';
    }
}
