
require('./bootstrap');
require('./particiles');
require('./functions');
window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter);
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

Vue.use(Buefy)

import App from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'
import HeaderTop from './components/HeaderTopMenu'
import Login from './components/Login'
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//Vue.component('header', require('./components/Header'));
Vue.component('header-top', HeaderTop);
Vue.component('header-login', Login);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
