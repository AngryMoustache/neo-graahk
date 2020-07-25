@extends('layout')

@section('content')
    <div class="tab-container lube">
        <x-lube.tabs />

        <div class="container-header">
            <h2 class="container-header-title">Editing {{ $label }}</h2>
        </div>

        <form
            class="lube-form"
            method="POST"
            action="{{ route("lube.$routeBase.update", ['id' => session('item')->id]) }}"
            enctype="multipart/form-data"
        >
            @csrf

            @method('PATCH')

            @foreach($form->fields as $field)
                {{ optional($field)->render() }}
            @endforeach
        </form>
    </div>
@endsection
