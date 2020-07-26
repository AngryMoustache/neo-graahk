<div class="{{ $field->divClass ?? 'form-row' }}">
    <div class="form-input">
        @include('lube.fields.label')

        <input
            type="{{ $field->type ?? 'text' }}"
            class="{{ $field->class }}"
            id="{{ $field->getName() }}"
            name="{{ $field->getName() }}"
            placeholder="{{ $field->getLabel() }}"
            value="{{ $field->getValue() }}"
        >
    </div>

    @include('lube.fields.error')
</div>
