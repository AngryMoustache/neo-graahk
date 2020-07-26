<div class="{{ $field->divClass ?? 'form-row' }}">
    <div class="form-input">
        @include('lube.fields.label')

        <input
            type="file"
            class="{{ $field->class }}"
            id="{{ $field->getName() }}"
            name="{{ $field->getName() }}"
            placeholder="{{ $field->getLabel() }}"
        >
    </div>

    @include('lube.fields.error')
</div>
