<div class="lube-card-data">
    <input
        type="hidden"
        wire:model="hiddenField"
        name="{{ $fieldName }}_json"
    >

    <div class="lube-card-data-picker">
        <div class="lube-card-data-picker-list">
            @foreach ($data as $key => $item)
                <div class="lube-card-data-picker-list-trigger">
                    <a class="button" wire:click="editTrigger({{ $key }})">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="button" wire:click="deleteTrigger({{ $key }})">
                        <i class="fas fa-trash"></i>
                    </a>
                    <h3>
                        @if (empty($item))
                            Empty trigger
                        @else
                            {{ ucfirst($item['trigger']) }}
                        @endif
                    </h3>
                </div>

                @if ($editingTrigger === $key)
                    <div class="modal lube-card-data-picker-modal">
                        <div class="modal-container">
                            <div class="modal-container-header">
                                <h2>Editing trigger</h2>
                                <a wire:click.prevent="closeModal">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>

                            <div class="modal-container-body">
                                <h3>Trigger</h3>
                                <select wire:model="data.{{$key}}.trigger">
                                    <option>-- Pick a trigger --</option>
                                    @foreach ($triggers as $trigger)
                                        <option value="{{ $trigger }}" >
                                            {{ $trigger }}
                                        </option>
                                    @endforeach
                                </select>

                                @if (optional($data[$key])['trigger'])
                                    <h3 class="margin-top">Events</h3>
                                    <select
                                        wire:model="pickingEvent"
                                        wire:change="addEvent({{ $key }})"
                                    >
                                        <option>-- Pick a new event --</option>
                                        @foreach ($events as $event)
                                            <option value="{{ $event }}" >
                                                {{ $event }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif

                                @if (optional($data[$key])['events'])
                                    @foreach ($data[$key]['events'] as $eKey => $event)
                                        <div class="lube-card-data-picker-modal-event">
                                            <h4>{{ $event['event'] }}</h4>
                                            <a
                                                class="remove-event"
                                                wire:click.prevent="deleteEvent({{ $key }}, {{ $eKey }})"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            @foreach ($event['parameters'] as $pKey => $parameter)
                                                <div class="lube-card-data-picker-modal-event-parameter">
                                                    <label for="{{ "$eKey-$pKey" }}">
                                                        {{ $pKey }}
                                                    </label>

                                                    @php $type = gettype($parameters[$event['event']][$pKey]) @endphp
                                                    @if ($type === 'array')
                                                        <select
                                                            wire:model="data.{{$key}}.events.{{$eKey}}.parameters.{{$pKey}}"
                                                            name="{{ "$eKey-$pKey" }}"
                                                            id="{{ "$eKey-$pKey" }}"
                                                        >
                                                            <option>-- Select value --</option>
                                                            @foreach ($parameters[$event['event']][$pKey] as $item)
                                                                <option value="{{ $item }}">{{ $item }}</option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <input
                                                            wire:model="data.{{$key}}.events.{{$eKey}}.parameters.{{$pKey}}"
                                                            type="text"
                                                            name="{{ "$eKey-$pKey" }}"
                                                            id="{{ "$eKey-$pKey" }}"
                                                        >
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="lube-card-data-picker-add">
            <a class="button" wire:click="addTrigger">
                <i class="fas fa-plus"></i>
                Add new trigger
            </a>
        </div>
    </div>

    @if ($previewText !== '')
        <div class="lube-card-data-preview">
            <h4>Preview text:</h4>
            <p>{{ $previewText }}</p>
        </div>
    @endif
</div>
