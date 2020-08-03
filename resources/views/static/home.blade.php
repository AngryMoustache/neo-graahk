@extends('layout')

@section('content')
    @guest
        <x-login />
        <x-register />
    @endguest
@endsection
