
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

Vue.component('menergy-form', require('./components/MenergyForm.vue'));
Vue.component('menergy-tabs', require('./components/MenergyTabs.vue'));
Vue.component('menergy-tab', require('./components/MenergyTab.vue'));

const app = new Vue({
    el: '#app'
});
