<div class="{{ $field->divClass ?? 'col-6' }} form-group required">
     @foreach ($field->options as $value => $label)
        <label class="flex items-center select-none" for="{{ $field->getName() . '.' . $loop->index }}">
            <input
                type="radio"
                class="{{ $field->class }}"
                id="{{ $field->getName() . '.' . $loop->index }}"
                name="{{ $field->getName() }}"
                value="{{ $value }}"
            >
            {{ $label }}
        </label>
    @endforeach

    @include('lube.fields.error')
</div>
