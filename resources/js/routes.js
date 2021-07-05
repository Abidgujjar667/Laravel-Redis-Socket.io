
let Home=require('./components/Home.vue').default;
let Login=require('./components/auth/Login.vue').default;
let Register=require('./components/auth/Register.vue').default;
let Forget=require('./components/auth/Forget.vue').default;

export const routes = [
    { path: '/', component: Home, name:'/' },
    { path: '/login', component: Login, name:'/login' },
    { path: '/register', component: Register, name:'/register' },
    { path: '/forget', component: Forget, name:'/forget' },
    /*{ path: '/bar', component: Bar }*/
];