
require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter);

//import global classes

import User from './Helpers/User';
window.User=User;

import Notification from './Helpers/Notification';
window.Notification=Notification;

// ES6 Modules or TypeScript
import Swal from 'sweetalert2'
window.Swal=Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.Toast=Toast;



import {routes} from './routes';
const router = new VueRouter({
    routes,
    mode:'history'
});

const app = new Vue({
    el: '#app',
    router
});
