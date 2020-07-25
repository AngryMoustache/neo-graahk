@extends('layout')

@section('content')
    <div class="tab-container lube">
        <x-lube.tabs />

        <div class="container-header">
            <h2 class="container-header-title">{{ $labelPlural }}</h2>
        </div>

        <div class="lube-above-table">
            <form class="lube-search">
                <input
                    type="text"
                    placeholder="Search {{ $labelPlural }}"
                    name="search"
                    value="{{ $search }}"
                >
            </form>

            <div class="lube-above-table-buttons">
                <a class="button" href="{{ route("lube.$routeBase.create") }}">
                    <i class="fas fa-plus"></i>
                    Create {{ $label }}
                </a>
            </div>
        </div>

        @php $fields = $fields->filter(fn ($field) => !$field->hideOnIndex); @endphp

        @if ($items->count() > 0)
            <table class="lube-index">
                <thead>
                    @foreach ($fields as $field)
                        <td>{{ $field->getLabel() }}</td>
                    @endforeach
                    <td colspan="3"></td>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            @foreach ($fields as $field)
                                <td>{{ optional($field)->item($item)->renderShow($item) }}</td>
                            @endforeach
                            <td class="lube-index-icon">
                                <a href="{{ route("lube.$routeBase.show", $item->id) }}">
                                    <i class="far fa-eye"></i>
                                </a>
                            </td>
                            <td class="lube-index-icon">
                                <a href="{{ route("lube.$routeBase.edit", $item->id) }}">
                                    <i class="far fa-edit"></i>
                                </a>
                            </td>
                            <td class="lube-index-icon">
                                <a href="{{ route("lube.$routeBase.delete", $item->id) }}">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="{{ count($fields) + 3}}">
                            @if (method_exists($items, 'links'))
                                {{ $items->withQueryString()->links() }}
                            @endif
                        </td>
                    </tr>
                </tfoot>
            </table>
        @else
            <h3>No {{ $labelPlural }} found.</h3>
        @endif
    </div>
@endsection
