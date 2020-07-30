<div class="{{ $field->divClass ?? 'form-row' }}">
    <div class="form-input">
        @include('lube.fields.label')

        <textarea
            class="{{ $field->class }}"
            id="{{ $field->getName() }}"
            name="{{ $field->getName() }}"
            placeholder="{{ $field->getLabel() }}"
        >{{ $field->getValue() }}</textarea>
    </div>

    @include('lube.fields.error')
</div>
