@extends('layout')

@section('content')
    <div class="container">
        <div class="container-header">
            <h2 class="container-header-title">{{ $news->title }}</h2>
        </div>

        <div class="container-body">
            <img
                 class="container-body-image"
                src="{{ optional($news->attachment)->format('newsItem') }}"
            >

            <div class="container-body-text">
                <div class="news-item-tags">
                    @foreach ($news->tags as $tag)
                        <x-tag :tag="$tag" />
                    @endforeach
                </div>
                <p>{!! nl2br($news->body) !!}</p>
            </div>
        </div>
    </div>
@endsection
