<div class="{{ $field->divClass ?? 'form-row' }}">
    @include('lube.fields.label')

    <textarea
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
    ></textarea>
</div>

<div class="form-error">
    @include('lube.fields.error')
</div>
