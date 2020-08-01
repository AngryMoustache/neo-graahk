@extends('layout')

@section('content')
    <div class="container">
        <div class="container-header">
            <h2 class="container-header-title">Server Browser</h2>
        </div>

        <div class="container-content browser">
            @dump($games)
        </div>
    </div>
@endsection
