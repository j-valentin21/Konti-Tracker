/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

let Chart = require('chart.js');

window.Vue = require('vue');

window.Fire = new Vue();

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
Vue.component('bar-chart', require('./components/BarChart.vue').default);
Vue.component('line-chart', require('./components/LineChart.vue').default);
Vue.component('pie-chart', require('./components/PieChart.vue').default);
Vue.component('calendar', require('./components/Calendar.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
