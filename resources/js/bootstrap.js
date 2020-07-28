import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

const token = document.head.querySelector('meta[name="csrf-token"]')

window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

Vue.use(VueAxios, axios)
window.Vue = require('vue')
Vue.component('deck-builder', require('./components/DeckBuilder.vue').default)
const app = new Vue({ el: '#app' })

require('./fit-text');
require('./deck-builder');
