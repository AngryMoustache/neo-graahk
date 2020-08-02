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

        $gameData['starting_player'] = collect();

        // Fill the decks and hands
        $players = [];
        foreach ($gameData['players'] as $player) {
            $userId = $player['user'];
            $gameData['starting_player']->push($player['user']);

            $deckList = collect(Deck::find($player['deck'])->getDeckListIds(true))
                ->map(fn ($value) => Card::find($value)->getVueInformation(false, $player['user']));
            $player['deck'] = $deckList->toArray();
            $player['hand'] = [];
            $player['graveyard'] = [];

            $player['user'] = User::find($userId)->getVueInformation();
            $player['energy'] = [
                'basic' => 0,
                'red' => 0,
                'blue' => 0,
            ];
            $player['power'] = 2000;
            $player['board'] = [];
            $players[$userId] = $player;
        }

        $gameData['players'] = $players;
        $gameData['state'] = 'started';
        $gameData['current'] = $gameData['starting_player']->random();
        $gameData['starting_player'] = $gameData['current'];

        $game->update(['game_data' => $gameData]);
        $pusherMessage = PusherMessage::create(['message' => $gameData]);
        event(new BoardUpdate($pusherMessage->id, $request->post('id')));
    }

    public function updateBoard(Request $request)
    {
        $gameData = $request->post('game_data');
        $pusherMessage = PusherMessage::create(['message' => $gameData]);
        Game::find($request->post('id'))->update(['game_data' => $gameData]);
        event(new BoardUpdate($pusherMessage->id, $request->post('id')));
    }
}
