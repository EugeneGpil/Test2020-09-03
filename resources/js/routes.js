import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Vue.component('Home', require('./pages/Home.vue')).default,
            children: [
                {
                    path: '/login',
                    name: 'login',
                    component: Vue.component('Login', require('./pages/Login.vue')).default,
                }
            ]
        },
    ],
});