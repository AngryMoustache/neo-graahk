<div class="{{ $field->divClass ?? 'form-row' }}">
    <div class="form-input">
        @include('lube.fields.label')

        @livewire('attachment-picker', ['field' => $field])
    </div>

    @include('lube.fields.error')
</div>
