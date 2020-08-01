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
Vue.component('render-deck-builder-cards', require('./components/RenderDeckBuilderCards.js').default)
Vue.component('game', require('./components/game/Game.vue').default)
Vue.component('card', require('./components/game/Card.vue').default)
require('./components/RenderDeckBuilderCards');

const app = new Vue({ el: '#app' })
