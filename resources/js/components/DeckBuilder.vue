<template>
  <div class="db">
    <slot
        :add-card="addCard"
        :content="content"
        :next-page="nextPage"
        :previous-page="previousPage"
        :deck-list="deckList"
        :remove-card="removeCard"
        :filters="filters"
        :filter="filter"
        :save-deck="saveDeck"
        :loading="loading"
        :toggle-showcase="toggleShowcase"
    />
  </div>
</template>

<script>
    export default {
        props: ['user', 'deck'],
        data () {
            return {
                content: '',
                loading: false,
                deckId: null,
                deckList: {
                    name: 'New Deck',
                    amount: 0,
                    cards: []
                },
                pagination: {
                    page: 1,
                    perPage: 8
                },
                filters: {
                    search: ''
                }
            }
        },
        mounted() {
            this.deckId = this.deck.id
            this.deckList = this.deck.deck
            this.countCards()
            this.fetchPage()
        },
        render(h) {
        return h({ content: this.content })
        },
        methods: {
            async fetchPage () {
                const data = {
                    user: this.user,
                    pagination: this.pagination,
                    filters: this.filters
                }

                await window.axios.post('/api/deck-builder/page', data).then((response) => {
                    this.content = response.data.view
                    this.pagination = response.data.pagination
                })

                window.resizeCards()
            },
            async nextPage () {
                this.pagination.page++
                this.fetchPage()
            },
            async previousPage () {
                this.pagination.page--
                this.fetchPage()
            },
            filter() {
                this.fetchPage()
            },
            addCard (card) {
                card = JSON.parse(card)
                var listCard = this.deckList.cards.findIndex((c) => c.id === card.id)
                if (listCard === -1) {
                    this.deckList.cards.push({
                        id: card.id,
                        name: card.name,
                        image: card.image,
                        cost: card.cost,
                        amount: 1,
                    })
                } else {
                    const size =  this.deckList.cards[listCard].amount
                    if (size < 4 || size < card.max) {
                        this.deckList.cards[listCard].amount = this.deckList.cards[listCard].amount + 1
                    }
                }

                this.countCards()
                this.$forceUpdate()
            },
            toggleShowcase (key) {
                for (var i = 0; i < this.deckList.cards.length; i++) {
                    this.deckList.cards[i].showcase = false
                }

                this.deckList.cards[key].showcase = true
                this.$forceUpdate()
            },
            removeCard (key) {
                this.deckList.cards[key].amount--
                if (this.deckList.cards[key].amount <= 0) {
                    this.$delete(this.deckList.cards, key)
                }

                this.countCards()
                this.$forceUpdate()
            },
            countCards () {
                var self = this
                this.deckList.amount = 0
                Object.values(this.deckList.cards).forEach(card => {
                    self.deckList.amount += card.amount
                })

                this.deckList.cards = Object.values(this.deckList.cards).sort(function (a, b) {
                    if (a.cost - b.cost !== 0) return a.cost - b.cost
                    if (b.cost - a.cost !== 0) return b.cost - a.cost
                    if (a.name < b.name) return -1
                    if (a.name > b.name) return 1
                    return 1
                })
            },
            async saveDeck () {
                this.loading = true

                await window.axios.post('/api/deck-builder/save', {
                    user: this.user,
                    deck: {
                        id: this.deckId,
                        list: this.deckList,
                    }
                })

                this.loading = false
            }
        }
    }
</script>
