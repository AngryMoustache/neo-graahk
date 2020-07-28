<table class="lube-card-stats-show">
    @foreach ($field->getValue() as $key => $value)
        <tr>
            <td>{{ ucfirst($key) }}</td>
            <td>{{ $value }}</td>
        </tr>
    @endforeach
</table>
