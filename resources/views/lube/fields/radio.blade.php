<div class="{{ $field->divClass ?? 'form-row' }} form-group required">
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
</div>

<div class="form-error">
    @include('lube.fields.error')
</div>
