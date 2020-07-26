@extends('layout')

@section('content')
    <div class="container">
        <div class="container-header">
            <h2 class="container-header-title">Editing {{ $deck->name }}</h2>
        </div>

        <div class="container-body">
            @livewire('deck-builder', [
                'deck' => $deck
            ])
        </div>
    </div>
@endsection
