<div class="{{ $field->divClass ?? 'col-6' }} form-group required">
    <input
        type="checkbox"
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
    >

    @include('lube.fields.label')

    @include('lube.fields.error')
</div>
