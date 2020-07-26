<div class="deck-builder">
    <div class="deck-builder-card-list">

        @foreach ($cards as $card)
            <x-game.card :card="$card" />
        @endforeach
    </div>
</div>
