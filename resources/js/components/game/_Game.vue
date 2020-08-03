<template>
    <div id="game">
        <div
            v-if="loaded"
            :class="'game' + (currentPlayerId.user.id === player.user.id ? ' current-player-id' : '')"
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
                    :game-data="gameData"
                    :player="player"
                    :opponent="opponent"
                    :current-player-id="currentPlayerId"
                />
            </div>

            <!-- Player info -->
            <div class="game-player-info">
                <player-info :player="player" :end-turn="endTurn" :current-player-id="currentPlayerId" />
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
    export default {
        props: ['user', 'game'],
        data () {
            return {
                loaded: false,
                player: null,
                opponent: null,
                currentPlayerId: null,
                gameData: null,
                animations: []
            }
        },
        async mounted() {
            this.setupPusher()

            // No phase? Game just started
            if (this.game.game_data.state === undefined) {
                await this.startGame()
            } else {
                this.gameData = this.game.game_data
                this.loaded = true
                this.parseNewBoardData()
            }
        },
        methods: {
            /**
             *
             * GAME METHODS
             *
             */
            event (name, ...data) {
                if (name === 'startGame') {
                    this.gainEnergy(this.currentPlayerId, 2)
                    this.drawCards(this.currentPlayerId, 3)
                    this.drawCards(this.currentOpponentId, 4)
                }

                if (name === 'startTurn') {
                    this.gainEnergy(this.currentPlayerId, 3)
                    this.drawCards(this.currentPlayerId, 1)
                }

                this.updateBoard()
            },

            isPlayerTurn () {
                return (this.currentPlayerId.user.id === this.player.user.id)
            },

            playCard (index, card) {
                if (!this.isPlayerTurn()) {
                    return;
                }

                if (this.player.energy.basic >= card.cost) {
                    this.player.energy.basic -= card.cost
                    this.player.board.push(card)
                    this.$delete(this.player.hand, index)
                }
            },

            /**
             *
             * GAME EVENTS
             *
             */
            drawCards (target, amount) {
                for (var i = 0; i < amount; i++) {
                    target.hand.push(target.deck.pop())
                }
            },

            gainEnergy (target, amount) {
                target.energy.basic += amount
            },

            endTurn () {
                if (!this.isPlayerTurn()) {
                    return;
                }

                this.gameData.currentPlayerId = this.opponent.user.id
                this.gameData.event = 'startTurn'
                this.updateBoard()
            },

            /**
             *
             * PUSHER METHODS
             *
             */
            setupPusher () {
                var pusher = new Pusher('9bb12fbb6aa54329b713', { cluster: 'eu' })
                var channel = pusher.subscribe('graahk-game-' + this.game.id)
                channel.bind('board-update', (data) => {
                    window.axios.get('/api/pusher-message/' + data.message).then((response) => {
                        this.gameData = response.data
                        this.parseNewBoardData()
                    })
                })
            },
            async startGame () {
                await window.axios.post('/api/game/start', this.game)
            },
            updateBoard () {
                // Make sure the correct data is sent
                this.gameData.players[this.player.user.id] = this.player
                this.gameData.players[this.opponent.user.id] = this.opponent
                window.axios.post('/api/game/update-board', {
                    id: this.game.id,
                    game_data: this.gameData
                })
            },
            parseNewBoardData () {
                var id = Object.keys(this.gameData.players).filter(key => key != this.user)[0]
                this.opponent = this.gameData.players[id]
                this.player = this.gameData.players[this.user]

                if (this.player.user.id === this.gameData.currentPlayerId) {
                     this.currentPlayerId = this.player
                     this.currentOpponentId = this.opponent
                } else {
                    this.currentPlayerId = this.opponent
                    this.currentOpponentId = this.player
                }

                this.loaded = true

                if (this.gameData.state === 'started') {
                    this.gameData.state = 'playing'
                    this.event('startGame')
                }

                if (this.gameData.event) {
                    this.event(this.gameData.event)
                    this.$delete(this.gameData, 'event')
                }

                this.$forceUpdate()
                this.$nextTick(() => { window.resizeCards() })
            }
        }
    }
</script>
