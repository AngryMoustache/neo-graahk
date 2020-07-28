require('./bootstrap');

window.resizeCards = function () {
  const cardCosts = document.querySelectorAll('.card-data-cost span')
  const cardNames = document.querySelectorAll('.card-data-name span')
  const cardPowers = document.querySelectorAll('.card-data-power span')
  const cardRarities = document.querySelectorAll('.card-data-rarity span')
  const cardTexts = document.querySelectorAll('.card-data-text span')

  for (let i = 0; i < cardCosts.length; i++) {
    window.fitText(cardCosts[i], 0.15)
  }

  for (let i = 0; i < cardNames.length; i++) {
    window.fitText(cardNames[i], 1.3)
  }

  for (let i = 0; i < cardPowers.length; i++) {
    window.fitText(cardPowers[i], 0.3)
  }

  for (let i = 0; i < cardTexts.length; i++) {
    window.fitText(cardTexts[i], 1.5)
  }

  for (let i = 0; i < cardRarities.length; i++) {
    window.fitText(cardRarities[i], 2.3)
  }
}

window.resizeCards()
window.addEventListener('resize', fitCardBuilder())
