<div class="db-content-card-list-cards">
    @foreach ($cards as $card)
        <div class="click-wrapper" v-on:click="addCard('{{ json_encode($card->getVueInformation()) }}')">
            <x-game.card :card="$card" :user="$user" />
        </div>
    @endforeach
</div>
