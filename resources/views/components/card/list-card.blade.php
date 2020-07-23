<div class="card-list-item">
    <div class="card-list-item-info">
        <div
            class="card-list-item-info-image"
            style="background-image: url({{ $card->attachment->format('thumb') }})"
        ></div>

        <div class="card-list-item-info-data">
            <h4>
                {{ $card->name }}
                @if ($rarity = $card->getRarity())
                    <span>{{ $rarity }}</span>
                @endif
            </h4>
        </div>
    </div>

    <div class="card-list-item-modal">
        <x-game.card :set="$set" :card="$card" />
    </div>
</div>
