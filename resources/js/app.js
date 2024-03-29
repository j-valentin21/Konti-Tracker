/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// import VueConfirmDialog from "@fullcalendar/vue/dist/main.global";

require('./bootstrap');

import Vue from 'vue'
window.Vue = require('vue');
window.Fire = new Vue();

import VueConfirmDialog from 'vue-confirm-dialog'
Vue.use(VueConfirmDialog);

require('chart.js');
require('places.js');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/LoginForm.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('login-form', require('./components/LoginForm.vue').default);
Vue.component('menu-btn', require('./components/MenuBtn.vue').default);
Vue.component('incrementers', require('./components/Incrementers.vue').default);
Vue.component('success-flash', require('./components/SuccessFlash.vue').default);
Vue.component('failure-flash', require('./components/FailureFlash.vue').default);
Vue.component('failure-flash-form', require('./components/FailureFlashForm.vue').default);
Vue.component('bar-chart', require('./components/BarChart.vue').default);
Vue.component('line-chart', require('./components/LineChart.vue').default);
Vue.component('pie-chart', require('./components/PieChart.vue').default);
Vue.component('calendar', require('./components/Calendar.vue').default);
Vue.component('weather', require('./components/Weather.vue').default);
Vue.component('forecast', require('./components/Forecast.vue').default);
Vue.component('request-pto-form', require('./components/RequestPTOForm.vue').default);
Vue.component('activity', require('./components/Activity.vue').default);
Vue.component('dashboard-activity', require('./components/DashboardActivity.vue').default);
Vue.component('notification', require('./components/Notification.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('vue-confirm-dialog', VueConfirmDialog.default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
