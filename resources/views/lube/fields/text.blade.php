<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('lube.fields.label')

    <input
        type="{{ $field->type ?? 'text' }}"
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
        value="{{ $field->getValue() }}"
    >

    @include('lube.fields.error')
</div>
