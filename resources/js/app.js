require('./bootstrap');
import Vue from 'vue'
import VueSweetalert2 from "vue-sweetalert2";
import 'sweetalert2/dist/sweetalert2.min.css';
import VueRouter from 'vue-router'
import Routes from './Routes'

Vue.use(VueRouter)
Vue.use(VueSweetalert2)

const app = new Vue({
    el: '#app',
    router: new VueRouter((Routes))
})
