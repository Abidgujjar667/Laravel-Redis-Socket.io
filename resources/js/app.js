
require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter);

//import global classes

import User from './Helpers/User';
window.User=User;

import {routes} from './routes';
const router = new VueRouter({
    routes,
    mode:'history'
});

const app = new Vue({
    el: '#app',
    router
});
