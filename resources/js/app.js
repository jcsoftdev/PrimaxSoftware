
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// require('./instascan.min');
// ES6 Modules or TypeScript
import Swal from 'sweetalert2';
import Datepicker from 'vuejs-datepicker';

// CommonJS
window.Swal = Swal;
window.Swal = require('sweetalert2');
window.Vue = require('vue');
window.toastr = require('toastr');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('venta-primax-component', require('./components/VentaPrimaxComponent.vue').default);
Vue.component('venta-pecsa-component', require('./components/VentaPecsaComponent.vue').default);
Vue.component('venta-pro-component', require('./components/VentaProComponent.vue').default);
Vue.component('reporte-venta', require('./components/ReporteVenta.vue').default);
Vue.component('usuario-component', require('./components/UserComponent.vue').default);
Vue.component('cupon-component', require('./components/CuponComponent.vue').default);
Vue.component('rol-component', require('./components/RolComponent.vue').default);
Vue.component('marca-component', require('./components/MarcaComponent.vue').default);
Vue.component('reporte-vendedor-component', require('./components/ReporteVendedorVenta.vue').default);
Vue.component('dashboard-component', require('./components/DashBoardComponent.vue').default);
Vue.component('datepicker', Datepicker)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(Toasted);
const app = new Vue({
    el: '#app',
    data: {
        menu: 0
    }
});
