<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('lube.fields.label')

    <textarea
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
    ></textarea>

    @include('lube.fields.error')
</div>
