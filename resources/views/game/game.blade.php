@extends('game-layout')

@section('content')
    <game
        :game="{{ json_encode($game->toArray()) }}"
        :user="{{ optional(auth()->user())->id }}"
    />
@endsection
