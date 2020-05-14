require('./bootstrap');
window.Vue = require('vue');
Vue.component('comprar', require('./components/comprar.vue').default);
Vue.component('cliente', require('./components/cliente.vue').default);
Vue.component('empleado', require('./components/empleado.vue').default);
Vue.component('producto', require('./components/producto.vue').default);
Vue.component('tarjeta', require('./components/tarjeta.vue').default);
Vue.component('tarjetas', require('./components/tarjetas.vue').default);
Vue.component('compras', require('./components/compras.vue').default);
Vue.component('pedidos', require('./components/pedidos.vue').default);
Vue.component('gpedidos', require('./components/gpedidos.vue').default);
Vue.component('devoluciones', require('./components/devoluciones.vue').default);
Vue.component('inventario', require('./components/inventario.vue').default);
Vue.component('estadisticas', require('./components/estadisticas.vue').default);
Vue.component('afiliados', require('./components/afiliados.vue').default);
Vue.component('ajustes', require('./components/ajustes.vue').default);
Vue.component('visorfacturas', require('./components/visorfacturas.vue').default);
Vue.component('nominas', require('./components/nominas.vue').default);
Vue.component('nomina', require('./components/nomina.vue').default);
Vue.component('reportes', require('./components/reportes.vue').default);
Vue.component('sorteo', require('./components/sorteo.vue').default);
const app = new Vue({
  el: '#v-app',
});