<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PusherMessage;

class PusherMessageController extends Controller
{
    public function __invoke($id)
    {
        $message = PusherMessage::find($id);
        return $message->message;
    }
}
