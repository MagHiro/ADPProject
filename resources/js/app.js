require('./bootstrap');
require('./ckeditor');

require('alpinejs');

import { createApp } from 'vue'
const Vue = createApp();
window.Vue = require('vue');
window.io = require("socket.io-client");

Vue.component('bid-countdown-timer', require('../js/components/BidCountdownTimer.vue').default);
Vue.component('new-bid', require('../js/components/NewBid.vue').default);
Vue.component('unique-bids', require('../js/components/UniqueBids.vue').default);
Vue.component('lot-status-badge', require('../js/components/LotStatusBadge.vue').default);
Vue.component('user-purchases', require('../js/components/UserPurchases.vue').default);

// const app = new Vue({
//     el: '#app'
// });

Vue.mount('#app');
