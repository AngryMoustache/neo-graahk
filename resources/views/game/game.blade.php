@extends('game-layout')

@section('content')
    <game
        :_game="{{ json_encode($game->toArray()) }}"
        :user="{{ optional(auth()->user())->id }}"
    />
@endsection
