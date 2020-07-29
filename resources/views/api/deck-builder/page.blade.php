@foreach ($cards as $card)
    <div class="click-wrapper" v-on:click="addCard($card->id)">
        <x-game.card :card="$card" :user="$user" />
    </div>
@endforeach
