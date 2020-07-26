<table class="lube-card-stats-show">
    @foreach (json_decode($field->getValue()) as $key => $value)
        <tr>
            <td>{{ ucfirst($key) }}</td>
            <td>{{ $value }}</td>
        </tr>
    @endforeach
</table>
