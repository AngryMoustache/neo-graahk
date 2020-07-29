@extends('deck-layout')

@section('content')
    <div class="container">
        <div class="container-body">
            <deck-builder
                :user="{{ optional(auth()->user())->id }}"
                :deck="{{ json_encode([
                    'id' => $deckId,
                    'deck' => $deck
                ]) }}"
            >
                <template v-slot:default="slot">
                    <div class="db-wrapper">
                        <div class="db-header">
                            <div class="db-header-filter">
                                <input
                                    type="text"
                                    placeholder="Search"
                                    v-model="slot.filters.search"
                                    v-on:change="slot.filter"
                                >
                            </div>
                        </div>

                        <div class="db-content">
                            <div class="db-content-card-list">
                                <div
                                    class="db-content-card-list-arrow arrow-left"
                                    v-on:click="slot.previousPage"
                                >
                                    <h2><i class="fas fa-angle-left"></i></h2>
                                </div>

                                <div class="vue-wrapper">
                                    <render-deck-builder-cards
                                        :add-card="slot.addCard"
                                        :string="slot.content"
                                    />
                                </div>

                                <div
                                    class="db-content-card-list-arrow arrow-right"
                                    v-on:click="slot.nextPage"
                                >
                                    <h2><i class="fas fa-angle-right"></i></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="db-content-deck-list">
                        <input
                            class="db-content-deck-list-title"
                            v-model="slot.deckList.name"
                        >

                        <div class="db-content-deck-list-counter">
                            <h2 :class="(slot.deckList.amount === 30 ? '' : 'red')">
                                <span v-html="slot.deckList.amount"></span>/30 cards
                            </h2>
                        </div>

                        <div class="db-table-scroll-wrapper">
                            <table class="db-content-deck-list-cards" cellpadding="0" cellspacing="1">
                                <tr
                                    class="db-content-deck-list-cards-card"
                                    v-for="(card, key) in slot.deckList.cards"
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
                                            v-on:click="slot.removeCard(key)"
                                        ></span>

                                        <span class="showcase-card">
                                            <i
                                                v-if="!card.showcase"
                                                class="fa fa-star-o"
                                                v-on:click="slot.toggleShowcase(key)"
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
                                <a href="{{ route('decks.index') }}" class="button">
                                    Back
                                </a>
                            </div>
                            <div class="db-content-deck-list-buttons-save">
                                <a
                                    class="button"
                                    v-on:click="slot.saveDeck"
                                    v-if="!slot.loading"
                                >
                                    Save deck
                                </a>
                                <a
                                    class="button disabled-button"
                                    v-if="slot.loading"
                                >
                                    Saving...
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </deck-builder>
    </div>
@endsection
