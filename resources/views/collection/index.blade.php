@extends('layout')

@section('content')
    <div class="set-overview">
        <div class="container">
            @foreach ($sets as $set)
                <div class="set">
                    <div class="set-header">
                        <div
                            class="set-header-image"
                            style="background-image: url({{ $set->icon }})"
                        ></div>

                        <div class="set-header-data">
                            <h2>{{ $set->name }}</h2>
                            <h3>{{ $set->cards->count() }} cards</h3>
                        </div>
                    </div>

                    <div class="set-cards">
                        <div class="card-list">
                            @foreach ($set->cards as $card)
                                <x-card.list-card :set="$set" :card="$card" />
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
