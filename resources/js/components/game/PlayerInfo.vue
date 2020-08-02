<template>
  <div class="player-info">
    <img
      class="player-info-frame"
      src="/../img/frames/frame.svg"
    />

    <div class="player-info-left">
      <div class="player-info-left-icon">
        <span>{{ player.deck.length }}</span>
        <i class="fas fa-layer-group"></i>
      </div>

      <div class="player-info-left-icon">
        <span>{{ player.hand.length }}</span>
        <i class="far fa-hand-paper"></i>
      </div>

      <div class="player-info-left-icon">
        <span>{{ player.graveyard.length }}</span>
        <i class="fas fa-skull"></i>
      </div>
    </div>

    <div class="player-info-middle">
      <div
        class="player-info-middle-avatar"
        :style="'background-image: url(' + player.user.avatar + ')'"
      >
        <span class="player-info-middle-avatar-power">{{ player.power }}</span>
      </div>
      <div v-if="player.user.id === currentPlayer.user.id" class="current-player"></div>
    </div>

    <div class="player-info-right">
      <div
        v-for="(energy, key) in player.energy"
        :key="key"
        class="player-info-right-icon"
      >
        <div v-if="key === 'basic' || energy > 0" :class="'energy-' + key">
          <span>{{ energy }}</span>
          <i class="fas fa-bolt"></i>
        </div>
      </div>
      <button v-if="endTurn" v-on:click="endTurn">END TURN</button>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['endTurn', 'player', 'currentPlayer'],
    data () {
      return {
      }
    },
    mounted () {

    }
  }
</script>
