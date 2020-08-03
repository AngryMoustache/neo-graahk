@extends('deck-layout')

@section('content')
    <div class="container">
        <div class="container-body">
            <deck-builder
                :user="{{ optional(auth()->user())->id }}"
                :sets="{{ json_encode($sets) }}"
                :full-card-list="{{ json_encode($cards) }}"
                back-route="{{ route('decks.index') }}"
                :deck="{{ json_encode([
                    'id' => $deckId,
                    'deck' => $deck,
                ]) }}"
            />
    </div>
@endsection
