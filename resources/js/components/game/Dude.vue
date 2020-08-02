<template>
  <div class="dude">
    <div
      class="dude-image"
      :style="'background-image: url(' + card.image + ')'"
    ></div>

    <img
      class="dude-frame"
      src="/../img/board/dude.svg"
    />

    <div class="dude-power">
      <span>{{ card.stats.power }}</span>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['card'],
    data () {
      return {

      }
    },
    mounted () {
    }
  }
</script>
