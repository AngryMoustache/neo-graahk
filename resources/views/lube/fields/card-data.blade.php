<div class="{{ $field->divClass ?? 'form-row' }}">
    @include('lube.fields.label')

    @livewire('card-data-field', ['field' => $field])
</div>

<div class="form-error">
    @include('lube.fields.error')
</div>
