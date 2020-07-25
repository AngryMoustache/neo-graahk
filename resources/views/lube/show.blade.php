@extends('layout')

@section('content')
    <div class="tab-container lube">
        <x-lube.tabs />

        <div class="container-header">
            <h2 class="container-header-title">Showing {{ $label }}</h2>
            <div class="container-header-buttons">
                <a class="button" href="{{ route("lube.$routeBase.delete", $item->id) }}">
                    <i class="far fa-trash-alt"></i>
                    Delete {{ $label }}
                </a>

                <a class="button" href="{{ route("lube.$routeBase.edit", $item->id) }}">
                    <i class="far fa-edit"></i>
                    Edit {{ $label }}
                </a>
            </div>
        </div>

        @php $fields = $fields->filter(fn ($field) => !$field->hideOnShow); @endphp

        <table class="lube-show">
            @foreach($fields as $field)
                <tr>
                    <td>{{ $field->getLabel() }}</td>
                    <td>{{ optional($field)->item($item)->renderShow() }}</td>
                </tr>
            @endforeach
        </ul>
    </div>
@endsection
