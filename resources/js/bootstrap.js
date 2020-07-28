window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue')
Vue.component('deck-builder', require('./components/DeckBuilder.vue').default)
const app = new Vue({ el: '#app' })

require('./fit-text');
require('./deck-builder');
