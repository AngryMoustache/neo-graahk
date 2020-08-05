@extends('layout')

@section('content')
    <div class="container">
        <div class="container-header">
            <h2 class="container-header-title">News</h2>
        </div>

        <div class="container-body news">
            @foreach ($news as $item)
                <x-news-item :item="$item" />
            @endforeach
        </div>
    </div>
@endsection
