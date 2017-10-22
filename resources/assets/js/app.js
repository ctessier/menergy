
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vue from 'vue'
import VueRouter from 'vue-router'
import MenergyApp from './MenergyApp'
import router from './router'
import store from './store'
import { date } from './filters'

Vue.use(VueRouter)
Vue.filter('date', date)

const app = new Vue({
    el: '#app',
    template: '<MenergyApp/>',
    components: {
        MenergyApp
    },
    router,
    store
});
