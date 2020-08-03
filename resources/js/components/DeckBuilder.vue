<template>
    <div class="db">
        <div class="db-wrapper">
            <div class="db-header">
                <div class="db-header-filter">
                    <input
                        type="text"
                        placeholder="Search"
                        v-model="filters.search"
                        v-on:change="filter"
                    >
                </div>

                <div class="db-header-filter checkboxes">
                    <div
                        class="checkbox"
                        v-for="set in sets"
                        :key="set.id"
                    >
                        <input
                            type="checkbox"
                            placeholder="Search"
                            v-model="filters.sets"
                            v-on:change="filter"
                            :id="'set_' + set.id"
                            :value="set.id"
                        >

                        <label
                            :for="'set_' + set.id"
                            v-html="set.name"
                        ></label>
                    </div>
                </div>
            </div>

            <div class="db-content">
                <div class="db-content-card-list">
                    <div
                        class="db-content-card-list-arrow arrow-left"
                        v-on:click="previousPage"
                    >
                        <h2 v-if="pagination.arrows">
                            <i class="fas fa-angle-left"></i>
                        </h2>
                    </div>

                    <div class="vue-wrapper">
                        <div class="db-content-card-list-cards" v-if="cards">
                            <div
                                class="click-wrapper"
                                v-for="(card, key) in cards"
                                :key="key"
                                v-on:click="addCard(card)"
                            >
                                <card :key="key" :card="card" />
                            </div>
                        </div>
                    </div>

                    <div
                        class="db-content-card-list-arrow arrow-right"
                        v-on:click="nextPage"
                    >
                        <h2 v-if="pagination.arrows">
                            <i class="fas fa-angle-right"></i>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="db-content-deck-list">
            <input
                class="db-content-deck-list-title"
                v-model="deckList.name"
            >

            <div class="db-content-deck-list-counter">
                <h2 :class="(deckList.amount === 30 ? '' : 'red')">
                    <span v-html="deckList.amount"></span>/30 cards
                </h2>
            </div>

            <div class="db-table-scroll-wrapper">
                <table class="db-content-deck-list-cards" cellpadding="0" cellspacing="1">
                    <tr
                        class="db-content-deck-list-cards-card"
                        v-for="(card, key) in deckList.cards"
                        :key="key"
                    >
                        <td class="db-content-deck-list-cards-card-amount">
                            x<span class="card-amount" v-html="card.amount"></span>
                        </td>
                        <td
                            class="db-content-deck-list-cards-card-name"
                            :style="'background-image: url(' + card.image + ')'"
                        >
                            <span
                                class="card-name"
                                v-html="card.name"
                                v-on:click="removeCard(key)"
                            ></span>

                            <span class="showcase-card">
                                <i
                                    v-if="!card.showcase"
                                    class="fa fa-star-o"
                                    v-on:click="toggleShowcase(key)"
                                ></i>

                                <i
                                    v-if="card.showcase"
                                    class="fa fa-star"
                                    v-on:click="toggleShowcase(key)"
                                ></i>
                            </span>
                        </td>
                        <td class="db-content-deck-list-cards-card-cost">
                            <span class="card-cost" v-html="card.cost"></span>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="db-content-deck-list-buttons">
                <div class="db-content-deck-list-buttons-cancel">
                    <a :href="backRoute" class="button">
                        Back
                    </a>
                </div>
                <div class="db-content-deck-list-buttons-save">
                    <a
                        class="button"
                        v-on:click="saveDeck"
                        v-if="!loading"
                    >
                        Save deck
                    </a>
                    <a
                        class="button disabled-button"
                        v-if="loading"
                    >
                        Saving...
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'deck', 'sets', 'fullCardList', 'backRoute'],
        data () {
            return {
                content: '',
                loading: false,
                cards: null,
                cardList: null,
                deckId: null,
                deckList: {
                    name: 'New Deck',
                    amount: 0,
                    cards: []
                },
                pagination: {
                    page: 1,
                    perPage: 8,
                    arrows: true
                },
                filters: {
                    search: '',
                    sets: []
                }
            }
        },
        mounted() {
            this.cards = this.cardList
            this.cardList = this.fullCardList
            this.deckId = this.deck.id
            this.deckList = this.deck.deck
            this.countCards()
            this.fetchCards()
        },
        methods: {
            nextPage () {
                this.pagination.page++
                if (this.pagination.page > Math.ceil(this.cardList.length / this.pagination.perPage)) {
                    this.pagination.page = 1
                }

                this.fetchCards()
            },
            previousPage () {
                this.pagination.page--
                if (this.pagination.page <= 0) {
                    this.pagination.page = Math.ceil(this.cardList.length / this.pagination.perPage)
                }

                this.fetchCards()
            },
            filter () {
                var self = this
                const search = self.filters.search.toLowerCase()
                const sets = self.filters.sets
                this.cardList = this.fullCardList.filter(function (card) {
                    // Text search
                    var textSearch = (card.name.toLowerCase().indexOf(search) !== -1)
                        || (card.stats.tribe.toLowerCase().indexOf(search) !== -1)
                        || (card.cost === search)
                        || (card.stats.power === search)

                    // Set search
                    var setSearch = true
                    if (sets.length !== 0) {
                        setSearch = false
                        Object.keys(card.sets).forEach(function (set) {
                            if (Object.values(sets).includes(parseInt(set))) {
                                setSearch = true
                            }
                        })
                    }

                    return textSearch && setSearch
                })

                this.fetchCards()
            },
            addCard (card) {
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
            fetchCards () {
                var pagination = this.pagination
                this.cards = null
                this.$nextTick(function () {
                    this.cards = this.cardList.filter(function (value, key) {
                        pagination.arrows = ((key + 1) > pagination.perPage)
                        return (key >= ((pagination.page - 1) * pagination.perPage))
                            && (key < ((pagination.page) * pagination.perPage))
                    })
                })
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
