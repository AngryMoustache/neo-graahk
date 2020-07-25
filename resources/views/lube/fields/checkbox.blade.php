<div class="{{ $field->divClass ?? 'form-row' }} form-group required">
    <input
        type="hidden"
        name="{{ $field->getName() }}"
        id="_{{ $field->getName() }}"
        value="{{ $field->getValue() ? 1 : 0 }}"
    >

    <input
        type="checkbox"
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        onchange="document.getElementById('_{{ $field->getName() }}').value = (this.checked ? 1 : 0)"
        @if ($field->getValue())
            checked
        @endif
    >

    @include('lube.fields.label')
</div>

<div class="form-error">
    @include('lube.fields.error')
</div>
