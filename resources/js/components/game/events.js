/**
 *
 * DRAW CARD
 *
 */
function drawCards (event) {
  var player = this.getPlayer(event.target)
  for (var i = 0; i < event.amount; i++) {
    player.hand.push(player.deck.pop())
  }
}

/**
 *
 * GAIN ENERGY
 *
 */
function gainEnergy (event) {
  var player = this.getPlayer(event.target)
  player.energy.basic += event.amount

  if (player.user.id === this.player.user.id) {
    this.createAnimation('.game-player-info .energy-basic', event.animation.name)
  } else {
    this.createAnimation('.game-opponent-info .energy-basic', event.animation.name)
  }
}

function playCardEvent (event) {
  var card = event.card
  var index = event.index
  var player = this.getPlayer(event.player)

  player.energy.basic -= card.cost
  player.board.push(card)
  player.hand.splice(index, 1)

  // this.trigger('enterField')
  // this.trigger('anyDudeEnterField')
  // this.trigger('selfDudeEnterField')
  // this.trigger('opponentDudeEnterField')
}

/**
 *
 * START FIRST TURN
 *
 */
function startFirstTurn () {
  this.fireEvent('drawCards', {
    amount: 5,
    target: this.currentPlayerId
  })

  this.fireEvent('drawCards', {
    amount: 4,
    target: this.currentOpponentId
  })

  this.fireEvent('gainEnergy', {
    amount: 2,
    target: this.currentPlayerId
  })
}

/**
 *
 * START TURN
 *
 */
function startTurn () {
  this.fireEvent('drawCards', {
    amount: 1,
    target: this.currentPlayerId
  })

  this.fireEvent('gainEnergy', {
    amount: 3,
    target: this.currentPlayerId
  })
}

/**
 *
 * EVENT ANIMATIONS LIST
 *
 */
const eventAnimations = {
    gainEnergy: {
        name: 'gain-energy',
        duration: 1000,
    },
    drawCards: {
        duration: 1,
    },
    playCardEvent: {
        duration: 1000,
    }
}

function getEventAnimation (name) {
  return { animation: eventAnimations[name] }
}

/**
 *
 * EXPORT
 *
 */
export {
  drawCards,
  gainEnergy,
  startFirstTurn,
  startTurn,
  playCardEvent,
  getEventAnimation,
}
