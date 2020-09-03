require('./bootstrap');

import Vue from 'vue';
import router from './routes.js';
import store  	 from './store.js'

import {initialize} from './helpers/general.js';
initialize(store, router);

const app = new Vue({
    el: '#app',
    router
});