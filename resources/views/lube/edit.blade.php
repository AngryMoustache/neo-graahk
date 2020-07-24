@extends('layout')

@section('content')
    <h2>Editing {{ $label }}</h2>
    <form
        method="POST"
        action="{{ route("lube.$routeBase.update", ['id' => session('item')->id]) }}"
    >
        @csrf

        @method('PATCH')

        @foreach($form->fields as $field)
            {{ optional($field)->render() }}
        @endforeach
    </form>
@endsection
