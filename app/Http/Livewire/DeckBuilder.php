<?php

namespace App\Http\Livewire;

use App\Models\Card;
use Livewire\Component;

class DeckBuilder extends Component
{
    public $deck;
    public $cards;

    public function mount($deck)
    {
        $this->deck = $deck;
    }

    public function render()
    {
        $this->cards = Card::orderBy('name')
            ->with('attachment', 'sets')
            ->get();

        return view('livewire.deck-builder');
    }
}
