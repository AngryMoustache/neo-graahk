<template>
  <div class="board">
    <div class="board-background">
      <div :class="'board-background-opponent' + (currentPlayerId === opponent.user.id ? ' current' : '')"></div>
      <div :class="'board-background-player' + (currentPlayerId === player.user.id ? ' current' : '')"></div>
    </div>

    <div class="board-dudes">
      <div class="board-dudes-opponent">
        <dude
          v-for="(card, key) in opponent.board"
          :key="key"
          :card="card"
        />
      </div>

      <div class="board-dudes-player">
        <dude
          v-for="(card, key) in player.board"
          :key="key"
          :card="card"
        />
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['player', 'opponent', 'currentPlayerId'],
    data () {
      return {

      }
    },
    mounted () {
    }
  }
</script>
