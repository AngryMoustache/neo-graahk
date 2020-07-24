@extends('layout')

@section('content')
    <a href="{{ route("lube.$routeBase.create") }}">Create {{ $label }}</a>
    <table>
        <thead>
            @foreach ($columns as $column)
                <td>{{ $column }}</td>
            @endforeach
            <td colspan="3"></td>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    @foreach (array_keys($columns) as $column)
                        <td>{{ $item->{$column} }}</td>
                    @endforeach
                    <td>
                        <a href="{{ route("lube.$routeBase.show", $item->id) }}">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route("lube.$routeBase.edit", $item->id) }}">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route("lube.$routeBase.delete", $item->id) }}">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
