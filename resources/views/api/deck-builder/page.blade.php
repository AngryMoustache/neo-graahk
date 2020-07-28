<div class="db-content-card-list">
    <div
        class="db-content-card-list-arrow"
        v-on:click="previousPage"
    >
        <h2><i class="fas fa-angle-left"></i></h2>
    </div>

    <div class="db-content-card-list-cards">
        @foreach ($cards as $card)
            <div class="click-wrapper">
                <x-game.card :card="$card" :user="$user" />
            </div>
        @endforeach
    </div>

    <div
        class="db-content-card-list-arrow"
        v-on:click="nextPage"
    >
        <h2><i class="fas fa-angle-right"></i></h2>
    </div>
</div>
