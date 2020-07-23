/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const app = new Vue({
    el: '#app',
});

const cardCosts = document.querySelectorAll('.card-data-cost span')
const cardNames = document.querySelectorAll('.card-data-name span')
const cardPowers = document.querySelectorAll('.card-data-power span')
const cardRarities = document.querySelectorAll('.card-data-rarity span')
const cardTexts = document.querySelectorAll('.card-data-text span')

for (let i = 0; i < cardCosts.length; i++) {
  window.fitText(cardCosts[i], 0.15)
}

for (let i = 0; i < cardNames.length; i++) {
  window.fitText(cardNames[i], 1)
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
