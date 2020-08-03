<div class="new-deck">
    <a href="#" class="deck-new" wire:click.prevent="openModal">
        <i class="fas fa-plus"></i>
        Create new deck
    </a>

    @if ($modal)
        <div class="new-deck-modal modal">
            <div class="modal-container">
                <div class="modal-container-header">
                    <h2>Create new deck</h2>
                    <a wire:click.prevent="closeModal">
                        <i class="fas fa-times"></i>
                    </a>
                </div>

                <div class="modal-container-body new-deck-form">
                    <div class="form">
                        <div class="form-row">
                            <div class="form-input">
                                <label for="name">Deck name</label>
                                <input type="text" name="name" id="name" wire:model="name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-input">
                                <label for="format">Format</label>
                                <select name="format" id="format" wire:model="format">
                                    @foreach ($formats as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row" style="border: 0px;">
                            <input
                                type="submit"
                                wire:click.prevent="createDeck"
                                value="Create new deck"
                            >
                        </div>
                    </div>

                    <br>

                    <h3 class="margin-top">Format: {{ $formats[$format] }}</h3>
                    <p>{!! nl2br($formatDescriptions[$format]) !!}</p>
                </div>
            </div>
        </div>
    @endif
</div>
