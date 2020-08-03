<template>
    <div id="game">
        <div
            v-if="loaded"
            :class="'game' + (currentPlayerId === player.user.id ? ' current-player-id' : '')"
        >
            <!-- Opponent hand -->
            <div class="game-opponent-hand">
                <div
                    v-for="(card, key) in opponent.hand"
                    :key="key"
                    class="game-opponent-hand-card"
                >
                    <hidden-card />
                </div>
            </div>

            <!-- Opponent info -->
            <div class="game-opponent-info">
                <player-info :player="opponent" :current-player-id="currentPlayerId" />
            </div>

            <!-- Game field -->
            <div class="game-board">
                <game-board
                    :player="player"
                    :opponent="opponent"
                    :current-player-id="currentPlayerId"
                />
            </div>

            <!-- Player info -->
            <div class="game-player-info">
                <player-info :player="player" :current-player-id="currentPlayerId" :end-turn="endTurn" />
            </div>

            <!-- Player hand -->
            <div class="game-hand">
                <div
                    v-for="(card, index) in player.hand"
                    :key="index"
                    class="game-hand-card"
                >

                    <card
                        :index="index"
                        :card="card"
                        :play-card="playCard"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { gainEnergy, drawCards, startFirstTurn, playCardEvent, startTurn } from './events.js'

    export default {
        props: ['user', '_game'],
        data () {
            return {
                loaded: false,

                player: null,
                opponent: null,
                currentPlayerId: null,
                currentOpponentId: null,

                events: [],
                eventRunning: false,
            }
        },
        async mounted() {
            this.game = this._game
            this.setupPusher()
            this.loadPlayers()
            this.loaded = true

            // Check if it's the first turn
            if (this.game.game_data.state === 'started' && this.isCurrentPlayer()) {
                this.game.game_data.state = 'main-phase'
                this.startFirstTurn()
                this.trigger('startTurn')
            }

            console.log(this.game)
        },
        methods: {
            /**
             *
             * GAME METHODS
             *
             */
            loadPlayers () {
                const playerId = this.user
                const opponentId = (this.game.user_1_id === playerId)
                    ? this.game.user_2_id
                    : this.game.user_1_id

                this.player = this.game.game_data.players[playerId]
                this.opponent = this.game.game_data.players[opponentId]
                this.currentPlayerId = this.game.game_data.current
                this.currentOpponentId = (this.game.user_1_id === this.game.game_data.current)
                    ? this.game.user_2_id
                    : this.game.user_1_id
            },

            getPlayer (id) {
                return (this.player.user.id === id)
                    ? this.player
                    : this.opponent
            },

            async fireEvent (name, ...params) {
                if (params.length === 1) {
                    params = params[0]
                }

                await window.axios.post('/api/game/fire-event', {
                    gameId: this.game.id,
                    name: name,
                    params: params
                })
            },

            isCurrentPlayer () {
                return (this.currentPlayerId === this.player.user.id)
            },

            trigger (name) {
                console.log('CHECKING TRIGGER', name)
            },

            playCard (index, card) {
                if (!this.isCurrentPlayer()) {
                    return;
                }

                // if (this.player.energy.basic >= card.cost) {
                    this.fireEvent('playCardEvent', {
                        card: card,
                        index: index,
                        player: this.player.user.id
                    })
                // }
            },

            endTurn () {
                if (!this.isCurrentPlayer()) {
                    return;
                }

                this.trigger('endTurn')
                this.game.game_data.current = this.currentOpponentId
                this.game.game_data.state = 'startTurn'
                this.saveBoard(true)
            },

            saveBoard (refresh = false) {
                var data = this.game
                data.game_data.players[this.player.user.id] = this.player
                data.game_data.players[this.opponent.user.id] = this.opponent
                data.refresh = refresh
                window.axios.post('/api/game/update-data', data)
            },

            /**
             *
             * ANIMATION METHODS
             *
             */
            handleNextEvent (key) {
                var event = this.events[key]
                if (!this.eventRunning && event !== undefined) {
                    var self = this
                    this.eventRunning = true

                    // v ACTUAL EVENT HERE v
                    if (this[event.name] !== undefined) {
                        console.log('FIRING EVENT', event)
                        this[event.name](event)
                    }
                    // ^ ACTUAL EVENT HERE ^

                    window.setTimeout(function () {
                        self.eventRunning = false
                        self.cleanAnimations()
                        self.handleNextEvent(key + 1)
                    }, event.animation.duration)
                } else {
                    // Save the board if you are the active player
                    if (this.isCurrentPlayer()) {
                        this.saveBoard()
                    }
                }
            },

            cleanAnimations () {
                const animations = document.querySelectorAll('.animation')
                for (var i = 0; i < animations.length; i++) {
                    animations[i].remove()
                }
            },

            createAnimation (target, name) {
                var image = document.createElement('img')
                image.setAttribute('class', 'animation animation-gain-energy')
                image.setAttribute('src', '/../img/game/animations/' + name + '.png')
                document.querySelector(target).appendChild(image)
            },

            /**
             *
             * PUSHER METHODS
             *
             */
            setupPusher () {
                var self = this
                var pusher = new Pusher('9bb12fbb6aa54329b713', { cluster: 'eu' })
                var channel = pusher.subscribe('graahk-game-' + this.game.id)
                channel.bind('board-update', (data) => {
                    if (typeof data.message === 'number') {
                        // Signals end of turn
                        window.axios.get('/api/pusher-message/' + data.message).then((response) => {
                            this.game.game_data = response.data
                            this.loadPlayers()

                            if (this.isCurrentPlayer() && this[this.game.game_data.state]) {
                                this[this.game.game_data.state]()
                            }
                        })
                    } else {
                        // Normal event
                        this.events.push(data.message)
                        this.handleNextEvent(this.events.length - 1)
                    }
                })
            },

            /**
             *
             * EVENTS
             *
             */
            drawCards,
            gainEnergy,
            startFirstTurn,
            startTurn,
            playCardEvent,
        }
    }
</script>
