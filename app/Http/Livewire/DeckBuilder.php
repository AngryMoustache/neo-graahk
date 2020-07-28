<?php

namespace App\Http\Livewire;

use App\Models\Card;
use Livewire\Component;

class DeckBuilder extends Component
{
    public $cards;
    public $page = 1;
    public $maxPage = 1;

    public function render()
    {
        $this->fetchCards();
        return view('livewire.deck-builder');
    }

    public function nextPage()
    {
        $this->page++;
    }

    public function previousPage()
    {
        if ($this->page !== 1) {
            $this->page--;
        }
    }

    public function fetchCards()
    {
        $this->cards = Card::orderBy('name')
            ->with('attachment', 'sets')
            ->offset(($this->page - 1) * 8)
            ->limit(8)
            ->get();

        if ($this->cards->isEmpty() && $this->page !== 1) {
            $this->page = 1;
            $this->fetchCards();
        }
    }
}
