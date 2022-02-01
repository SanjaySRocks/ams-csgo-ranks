require('./bootstrap');

// window.Vue = require('vue').default;

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// const app = new Vue({
//     el: '#app',
// });

import Vue from 'vue'
import App from './App.vue'
import router from './router';


import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";

Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    vuetify: new Vuetify(),
});