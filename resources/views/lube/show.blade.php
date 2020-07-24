@extends('layout')

@section('content')
    <h2>Showing {{ $label }}</h2>
    @dump($item)
@endsection
