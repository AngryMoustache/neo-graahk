<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Deck;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DeckController extends Controller
{
    public function index()
    {
        $decks = Deck::where('user_id', auth()->user()->id)->get();

        return view('deck.index', [
            'decks' => $decks
        ]);
    }

    public function new()
    {
        $deck = Deck::create([
            'user_id' => auth()->user()->id,
            'name' => 'New deck',
            'slug' => ''
        ]);

        $slug = Str::slug($deck->name);
        $deck->slug = "{$deck->id}-{$slug}";
        $deck->save();

        return redirect(route('decks.edit', $deck));
    }

    public function edit(Deck $deck)
    {
        if (!(Auth::user()->id === $deck->user->id)) {
            return redirect(route('decks.index'));
        }

        $cards = $deck->cards
            ->map(fn (Card $card) => $card->getVueInformationWithAmount())
            ->toArray();

        return view('deck.edit', [
            'deckId' => $deck->id,
            'deck' => [
                'name' => $deck->name,
                'cards' => $cards,
                'amount' => 0,
            ]
        ]);
    }

    public function duplicate(Deck $deck)
    {
        if (!(Auth::user()->id === $deck->user->id)) {
            return redirect(route('decks.index'));
        }

        $new = $deck->duplicate();
        $slug = Str::slug($deck->name);
        $new->slug = "{$new->id}-{$slug}";
        $new->save();

        return redirect(route('decks.edit', [
            'deck' => $new->slug
        ]));
    }

    public function delete(Deck $deck)
    {
        if (!(Auth::user()->id === $deck->user->id)) {
            return redirect(route('decks.index'));
        }

        $deck->cards()->detach();
        $deck->delete();

        return redirect(route('decks.index'));
    }
}
