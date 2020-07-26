<div class="lube-card-stats">
    <input
        type="hidden"
        wire:model="hiddenField"
        name="{{ $fieldName }}"
    >

    <select
        wire:model="data.type"
        class="lube-card-stats-select"
        name="card-type"
    >
        <option>-- Select a card type --</option>
        @foreach ($types as $type)
            <option value="{{ $type }}">
                {{ ucfirst($type) }}
            </option>
        @endforeach
    </select>

    @if ($data['type'] ?? null)
        <div class="lube-card-stats-fields">
            @foreach (($fields[$data['type']] ?? []) as $field)
                <div class="lube-card-stats-fields-field">
                    <label for="{{ $field }}">
                        {{ ucfirst($field) }}
                    </label>

                    <input
                        type="text"
                        wire:model.lazy="data.{{ $field }}"
                        placeholder="{{ ucfirst($field) }}"
                    >
                </div>
            @endforeach
        </div>
    @endif
</div>
