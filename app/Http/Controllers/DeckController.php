<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use Illuminate\Support\Facades\Auth;

class DeckController extends Controller
{
    public function index()
    {
        $decks = Deck::get();

        return view('deck.index', [
            'decks' => $decks
        ]);
    }

    public function edit(Deck $deck)
    {
        if (!(Auth::user()->id === $deck->user->id)) {
            return redirect(route('decks.index'));
        }

        return view('deck.edit', [
            'deck' => $deck
        ]);
    }

    public function duplicate(Deck $deck)
    {
        if (!(Auth::user()->id === $deck->user->id)) {
            return redirect(route('decks.index'));
        }

        $new = $deck->duplicate();

        return redirect(route('deck.edit', [
            'deck' => $new->slug
        ]));
    }
}
