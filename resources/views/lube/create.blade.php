@extends('layout')

@section('content')
    <h2>Creating new {{ $label }}</h2>
    <form
        method="POST"
        action="{{ route("lube.$routeBase.store") }}"
    >
        @csrf

        @foreach($form->fields as $field)
            {{ optional($field)->render() }}
        @endforeach
    </form>
@endsection
