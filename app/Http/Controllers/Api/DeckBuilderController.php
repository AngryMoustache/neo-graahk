<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deck;
use App\Models\User;
use Illuminate\Http\Request;

class DeckBuilderController extends Controller
{
    protected $pagination;
    protected $filters;

    public function save(Request $request)
    {
        $user = User::find($request->post('user'));
        $deck = Deck::find($request->post('deck')['id']);
        if ($deck->user->id !== $user->id) {
            abort(403);
        }

        $deck->name = $request->post('deck')['list']['name'];
        $deck->save();

        $pivots = [];
        collect($request->post('deck')['list']['cards'])
            ->each(function ($card) use (&$pivots) {
                $pivots[] = [
                    'showcase' => ($card['showcase'] ?? false) ? 1 : 0,
                    'amount' => $card['amount'],
                    'card_id' => $card['id'],
                ];
            });

        $deck->cards()->detach();
        $deck->cards()->sync($pivots);
    }
}
