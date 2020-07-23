<?php

namespace App\Http\Controllers;

use App\Models\Card;

class StaticController extends Controller
{
    public function home()
    {
        $cards = Card::get();

        return view('static.home', [
            'cards' => $cards
        ]);
    }
}
