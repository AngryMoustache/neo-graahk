<div class="{{ $field->divClass ?? 'form-row' }}">
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

<div class="form-error">
    @include('lube.fields.error')
</div>
