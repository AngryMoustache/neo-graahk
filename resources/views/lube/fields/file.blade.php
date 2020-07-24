<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('lube.fields.label')

    <input
        type="file"
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
    >

    @include('lube.fields.error')
</div>
