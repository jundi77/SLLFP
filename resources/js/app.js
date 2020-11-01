/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// const { default: Vuetify } = require('vuetify/lib');

require('./bootstrap');

window.Vue = require('vue');
// window.Vuetify = require('vuetify')

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.use(Vuetify)
Vue.component('poll-list',require('./components/PollListComponent.vue').default);
Vue.component('poll-choice', require('./components/PollChoiceComponent.vue').default);
// Vue.component('vote-history', require('./components/VoteHistoryComponent.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// midtrans
const midtransClient = require('midtrans-client');

window.app = new Vue({
    el: '#poll-app',
});