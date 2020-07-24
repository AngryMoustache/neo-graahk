<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('lube.fields.label')

    <select
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
    >
        <option value="">{{ __('form.select an option') }}</option>
        @foreach ($field->options as $key => $value)
            <option value="{{ $field->useValueAsKeys ? $value : $key  }}">
                {{ $value }}
            </option>
        @endforeach
    </select>

    @include('lube.fields.error')
</div>
