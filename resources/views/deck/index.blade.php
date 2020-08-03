@extends('layout')

@section('content')
    <div class="container">
        <div class="container-header">
            <h2 class="container-header-title">Your decks</h2>
        </div>

        <div class="container-content deck-list">
            @foreach ($decks as $deck)
                <x-game.deck-panel :deck="$deck" />
            @endforeach
        </div>

        @livewire('new-deck')
    </div>
@endsection
