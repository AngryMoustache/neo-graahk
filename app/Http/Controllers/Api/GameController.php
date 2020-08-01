<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Events\BoardUpdate;
use App\Models\Card;
use App\Models\Deck;
use App\Models\Game;
use App\Models\PusherMessage;
use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function start(Request $request)
    {
        $game = Game::find($request->post('id'));
        $gameData = $request->post('game_data');

        // Fill the decks and hands
        $players = [];
        foreach ($gameData['players'] as $key => $player) {
            $userId = $player['user'];

            $deckList = collect(Deck::find($player['deck'])->getDeckListIds(true))
                ->map(fn ($value) => Card::find($value)->getVueInformation(false, $player['user']));
            $player['hand'] = $deckList->take(5)->toArray();
            $player['deck'] = $deckList->splice(5)->toArray();

            $player['user'] = User::find($userId)->getVueInformation();
            $player['energy'] = [];
            $player['power'] = 2000;
            $players[$userId] = $player;
        }

        $gameData['players'] = $players;
        $gameData['state'] = 'started';

        $game->update(['game_data' => $gameData]);
        $pusherMessage = PusherMessage::create(['message' => json_encode($gameData)]);
        event(new BoardUpdate($pusherMessage->id, $request->post('id')));
    }

    public function updateBoard(Request $request)
    {
        $gameData = $request->post('game_data');
        $pusherMessage = PusherMessage::create(['message' => json_encode($gameData)]);
        event(new BoardUpdate($pusherMessage->id, $request->post('id')));
    }
}
