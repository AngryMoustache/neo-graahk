<div class="lube-habtm">
    <input
        type="hidden"
        wire:model="parsedValue"
        name="{{ $fieldName }}"
    >

    <div class="lube-habtm-table">
        <div class="lube-habtm-table-column lube-habtm-table-column-left">
            <table>
                @foreach ($unselected as $key => $item)
                    <tr wire:click="select({{ $key }})">
                        <td>{{ $key }}</td>
                        <td>{{ $item }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="lube-habtm-table-column lube-habtm-table-column-middle">
            <i class="fa fa-exchange"></i>
        </div>

        <div class="lube-habtm-table-column lube-habtm-table-column-right">
            <table>
                @foreach ($selected as $key => $item)
                    <tr wire:click="unselect({{ $key }})">
                        <td>{{ $key }}</td>
                        <td>{{ $item }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
