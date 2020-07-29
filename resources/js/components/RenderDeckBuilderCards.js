Vue.component('render-deck-builder-cards', {
    props: ['string', 'addCard'],
    render(h) {
      const render = {
        template: this.string,
        data: () => ({
          addCard: this.addCard
        })
      }

      return h(render)
    }
})
