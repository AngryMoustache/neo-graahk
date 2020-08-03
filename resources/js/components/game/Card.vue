<template>
    <div
      :class="cardClass"
      v-on:click="(playCard ? playCard(index, _card) : '')"
    >
      <div class="card-container" v-if="loaded">
        <div
          class="card-overlay"
          :style="'background-image: url(\'../img/cards/dude-' +  (_card.rarity.toLowerCase() || 'common') + '.svg\');'"
        ></div>

        <div
          class="card-image"
          :style="'background-image: url(' + _card.image + ')'"
        ></div>

        <div
          class="card-set-logo"
          :style="'background-image: url(' +  _card.setIcon + ');'"
        ></div>

        <div class="card-data">
          <div class="card-data-cost"><span>{{ _card.stats.cost }}</span></div>
          <div class="card-data-name"><span>{{ _card.name }}</span></div>
          <div class="card-data-rarity">
            <span>
              {{ _card.stats.tribe }}
              {{ _card.stats.type }}
            </span>
          </div>
          <div class="card-data-power"><span>{{ _card.stats.power }}</span></div>
          <div class="card-data-text"><span>{{ _card.text }}</span></div>
        </div>
      </div>
  </div>
</template>

<script>
  export default {
    props: ['index', 'card', 'playCard'],
    data () {
      return {
        cardClass: 'card',
        loaded: false,
      }
    },
    mounted () {
      this._card = (typeof this.card === 'string')
        ? JSON.parse(this.card)
        : this.card

      const fullart = (this._card.rarity === 'Extraordinary' || this._card.rarity === 'Fabulous')
      this.cardClass += fullart ? ' card-fullart' : ''
      this.cardClass += ' card-' + this._card.stats.type
      this.cardClass += ' card-' + this._card.rarity

      this.loaded = true
      this.$nextTick(function () {
          window.resizeCards()
      })
    }
  }
</script>
