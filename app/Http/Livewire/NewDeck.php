<?php

namespace App\Http\Livewire;

use App\Models\Deck;
use App\Models\Format;
use Illuminate\Support\Str;
use Livewire\Component;

class NewDeck extends Component
{
    public $modal = false;
    public $formats;
    public $formatDescriptions;
    public $format = 1;
    public $name = 'New Deck';

    public function mount()
    {
        $this->formats = Format::pluck('name', 'id')->toArray();
        $this->formatDescriptions = Format::pluck('description', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.new-deck');
    }

    public function createDeck()
    {
        $deck = Deck::create([
            'user_id' => auth()->user()->id,
            'format_id' => $this->format,
            'name' => $this->name,
            'slug' => ''
        ]);

        $slug = Str::slug($deck->name);
        $deck->slug = "{$deck->id}-{$slug}";
        $deck->save();

        return redirect(route('decks.edit', $deck));
    }

    public function openModal()
    {
        $this->modal = true;
    }

    public function closeModal()
    {
        $this->modal = false;
    }
}
