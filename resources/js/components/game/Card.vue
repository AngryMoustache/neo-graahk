<template>
  <div>
    <div :class="cardClass">
      <div class="card-container">
        <div class="card-overlay"></div>
        <div
          class="card-image"
          :style="'background-image: url(' + card.image + ')'"
        ></div>
        <!-- <div class="card-set-logo" style="background-image: url({{ set.icon.path() }})"></div> -->
        <div class="card-data">
          <div class="card-data-cost"><span>{{ card.stats.cost }}</span></div>
          <div class="card-data-name"><span>{{ card.name }}</span></div>
          <div class="card-data-rarity">
            <span>
              {{ card.stats.tribe }}
              {{ card.stats.type }}
            </span>
          </div>
          <div class="card-data-power"><span>{{ card.stats.power }}</span></div>
          <div class="card-data-text"><span>{{ card.text }}</span></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['card'],
    data () {
      return {
        cardClass: 'card '
      }
    },
    mounted () {
      const fullart = (this.card.rarity === 'Extraordinary' || this.card.rarity === 'Fabulous')
      this.cardClass += fullart ? 'card-fullart ' : ''
      this.cardClass += 'card-' + this.card.stats.type
    }
  }
</script>
