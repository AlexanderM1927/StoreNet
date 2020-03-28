require('./bootstrap');
window.Vue = require('vue');
Vue.component('comprar', require('./components/comprar.vue').default);
const app = new Vue({
  el: '#v-app',
});