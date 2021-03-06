<div class="{{ $field->divClass ?? 'form-row' }}">
    <div class="form-input">
        @include('lube.fields.label')

        <input
            type="date"
            class="{{ $field->class }}"
            id="{{ $field->getName() }}"
            name="{{ $field->getName() }}"
            placeholder="{{ $field->getLabel() }}"
            value="{{ (old($field->getName()) ?? $field->getValue()) }}"
        >
    </div>

    @include('lube.fields.error')
</div>
