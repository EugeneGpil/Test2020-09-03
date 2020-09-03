import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import { me } from './modules/me.js';

export default new Vuex.Store({
	modules: {
    	me,
	},
});