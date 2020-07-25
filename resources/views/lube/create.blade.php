@extends('layout')

@section('content')
    <div class="tab-container lube">
        <x-lube.tabs />

        <div class="container-header">
            <h2 class="container-header-title">Creating {{ $label }}</h2>
        </div>

        <form
            class="lube-form"
            method="POST"
            action="{{ route("lube.$routeBase.store") }}"
            enctype="multipart/form-data"
        >
            @csrf

            @foreach($form->fields as $field)
                {{ optional($field)->render() }}
            @endforeach
        </form>
    </div>
@endsection
