<template>
    <div id="game">
        <div class="game" v-if="gameData">
            <!-- Player hand -->
            <div class="game-hand">
                <div
                    v-for="(card, key) in gameData.players[user].hand"
                    :key="key"
                    class="game-hand-card"
                >
                    <card :card="card"></card>
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
                gameData: null,
                animations: []
            }
        },
        async mounted() {
            this.setupPusher()

            // No phase? Game just started
            if (this.game.game_data.state === undefined) {
                await this.startGame()
            }

            this.gameData = this.game.game_data
            this.parseNewBoardData()
        },
        methods: {
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
                window.axios.post('/api/game/update-board', {
                    id: this.game.id,
                    game_data: this.gameData
                })
            },
            parseNewBoardData () {
                this.$forceUpdate()
                this.$nextTick(() => {
                    window.resizeCards()
                })
            }
        }
    }
</script>
