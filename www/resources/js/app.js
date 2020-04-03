require('./bootstrap');
window.Vue = require('vue');
Vue.component('comprar', require('./components/comprar.vue').default);
Vue.component('cliente', require('./components/cliente.vue').default);
Vue.component('empleado', require('./components/empleado.vue').default);
Vue.component('producto', require('./components/producto.vue').default);
Vue.component('tarjeta', require('./components/tarjeta.vue').default);
Vue.component('tarjetas', require('./components/tarjetas.vue').default);
Vue.component('compras', require('./components/compras.vue').default);
const app = new Vue({
  el: '#v-app',
});