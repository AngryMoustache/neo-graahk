<ul>
    @foreach ($field->getValue() as $item)
        <li>- {{ $item->{$field->itemLabelKey} }}</li>
    @endforeach
</ul>
