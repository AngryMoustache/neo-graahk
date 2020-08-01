<div class="{{ $field->divClass ?? 'form-row' }} form-group required">
    <div class="form-input">
        <input
            type="hidden"
            name="{{ $field->getName() }}"
            id="_{{ $field->getName() }}"
            value="{{ (old($field->getName()) ?? $field->getValue()) ? 1 : 0 }}"
        >

        <input
            type="checkbox"
            class="{{ $field->class }}"
            id="{{ $field->getName() }}"
            onchange="document.getElementById('_{{ $field->getName() }}').value = (this.checked ? 1 : 0)"
            @if ((old($field->getName()) ?? $field->getValue()))
                checked
            @endif
        >

        @include('lube.fields.label')
    </div>

    @include('lube.fields.error')
</div>
