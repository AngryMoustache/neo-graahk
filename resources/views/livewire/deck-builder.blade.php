<div class="db-livewire">
    <div class="db-header">

    </div>

    <div class="db-content">
        <div class="db-content-card-list">
            <div class="db-content-card-list-arrow" wire:click="previousPage">
                <h2><i class="fas fa-angle-left"></i></h2>
            </div>

            <div class="db-content-card-list-cards">
                @foreach ($cards as $card)
                    <div class="click-wrapper">
                        <x-game.card :card="$card" />
                    </div>
                @endforeach
            </div>

            <div class="db-content-card-list-arrow" wire:click="nextPage">
                <h2><i class="fas fa-angle-right"></i></h2>
            </div>
        </div>
    </div>
</div>
