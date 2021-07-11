
let Home=require('./components/Home.vue').default;
let Login=require('./components/auth/Login.vue').default;
let Register=require('./components/auth/Register.vue').default;
let Forget=require('./components/auth/Forget.vue').default;
let Logout=require('./components/auth/Logout.vue').default;

let AddEmployee=require('./components/employee/Create.vue').default;
let Employee=require('./components/employee/Index.vue').default;

export const routes = [
    { path: '/', component: Login, name:'login' },
    { path: '/register', component: Register, name:'register' },
    { path: '/forget', component: Forget, name:'forget' },
    { path: '/logout', component: Logout, name:'logout' },
    { path: '/home', component: Home, name:'home' },

    { path: '/add-employee', component: AddEmployee, name:'add-employee' },
    { path: '/employee', component: Employee, name:'employee' },
    /*{ path: '/bar', component: Bar }*/
];