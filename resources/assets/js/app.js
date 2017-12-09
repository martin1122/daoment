/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('axios');
require('chart.js');
require('lodash');
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('index', require('./components/Index.vue'));
Vue.component('graph', require('./components/Graph.vue'));
Vue.component('coins', require('./components/coins'));
Vue.component('indices', require('./app/home/indices'));

const app = new Vue({
    el: '#app',
});
