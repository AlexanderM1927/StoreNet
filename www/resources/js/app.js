require('./bootstrap');
window.Vue = require('vue');
Vue.component('comprar', require('./components/comprar.vue').default);
Vue.component('cliente', require('./components/cliente.vue').default);
Vue.component('empleado', require('./components/empleado.vue').default);
const app = new Vue({
  el: '#v-app',
});