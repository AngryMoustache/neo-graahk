import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
require('./fit-text');
require('./deck-builder');

const token = document.head.querySelector('meta[name="csrf-token"]')

window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
window.compiler = require('vue-template-compiler')

Vue.use(VueAxios, axios)
window.Vue = require('vue')

Vue.component('deck-builder', require('./components/DeckBuilder.vue').default)
Vue.component('game', require('./components/game/Game.vue').default)
Vue.component('card', require('./components/game/Card.vue').default)
Vue.component('hidden-card', require('./components/game/HiddenCard.vue').default)
Vue.component('player-info', require('./components/game/PlayerInfo.vue').default)
Vue.component('game-board', require('./components/game/GameBoard.vue').default)
Vue.component('dude', require('./components/game/Dude.vue').default)

const app = new Vue({ el: '#app' })
