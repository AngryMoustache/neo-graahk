<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Deck;
use App\Models\Format;
use App\Models\Set;
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

    public function edit(Deck $deck)
    {
        if (!(Auth::user()->id === $deck->user->id)) {
            return redirect(route('decks.index'));
        }

        $deckCards = $deck->cards
            ->map(fn (Card $card) => $card->getVueInformationWithAmount())
            ->toArray();

        $format = $deck->format_id;
        $cards = Card::whereHas('formats', function ($q) use ($format) {
                $q->where('format_id', $format);
            })
            ->orWhereHas('sets', function ($q) use ($format) {
                $q->whereHas('formats', function ($q) use ($format) {
                    $q->where('format_id', $format);
                });
            })
            ->get()
            ->map(fn (Card $card) => $card->getVueInformationWithAmount())
            ->toArray();

        return view('deck.edit', [
            'deckId' => $deck->id,
            'sets' => Set::getForVue(),
            'formats' => Format::getForVue(),
            'cards' => $cards,
            'deck' => [
                'name' => $deck->name,
                'cards' => $deckCards,
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
