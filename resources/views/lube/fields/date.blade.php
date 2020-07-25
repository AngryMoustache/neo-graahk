<div class="{{ $field->divClass ?? 'form-row' }}">
    @include('lube.fields.label')

    <input
        type="date"
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
    >
</div>

<div class="form-error">
    @include('lube.fields.error')
</div>
