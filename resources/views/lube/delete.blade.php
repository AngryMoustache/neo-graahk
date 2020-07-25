@extends('layout')

@section('content')
    <div class="tab-container lube">
        <x-lube.tabs />

        <div class="container-header">
            <h2 class="container-header-title">Deleting {{ $label }}</h2>
        </div>

        <p>Are you sure you wish to delete {{ strtolower($label) }} {{ $item->id }}?</p>

        <form class="lube-delete" method="POST">
            @csrf
            @method('delete')
            <a href="{{ route("lube.$routeBase.index") }}" class="button-decline button">No</a>
            <input type="submit" class="button-accept button" value="Yes">
        </form>
    </div>
@endsection
