require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import Routes from './Routes'

Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router: new VueRouter((Routes))
})
