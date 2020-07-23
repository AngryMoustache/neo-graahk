@extends('layout')

@section('content')
    @foreach ($sets as $set)
        <img src="{{ $set->attachment->format('thumb') }}" alt="{{ $set->attachment->alt_name }}">
        <h2>{{ $set->name }}</h2>

        <div class="set-cards">
            @foreach ($set->cards as $card)
                <x-game.card :card="$card" />
            @endforeach
        </div>
    @endforeach
@endsection
