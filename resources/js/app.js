require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
import VueSweetalert2 from 'vue-sweetalert2'
import vSelect from 'vue-select'
import App from './App'
import routes from './routes'

import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue-select/dist/vue-select.css';

Vue.use(VueRouter)
Vue.use(VueSweetalert2)
Vue.use(vSelect)

const router = new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: "active",
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
