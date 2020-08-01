<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function browser()
    {
        $games = Game::where('status', '!=', 'ended')->get();
        return view('game.browser', [
            'games' => $games
        ]);
    }

    public function game(Game $game)
    {
        $user = false;
        if (Auth::user()->id === $game->userOne->id) { $user = $game->userOne->id; }
        if (Auth::user()->id === $game->userOne->id) { $user = $game->userOne->id; }
dd(Deck::first()->cards->pluck('id'));
        return view('game.game', [
            'game' => $game,
            'user' => $user,
        ]);
    }
}
