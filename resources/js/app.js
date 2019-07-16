
require('./bootstrap');
require('./particiles');
require('./functions');
window.Vue = require('vue');
import VueRouter from 'vue-router'
import Multiselect from 'vue-multiselect'
Vue.use(VueRouter);

import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import * as VueGoogleMaps from 'vue2-google-maps';
import Swal from 'sweetalert2'

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyB7bSuHoE_CtSITfN1gUUPNULV704buZ7o',
        libraries: 'places',
        language:'EN'
    },
})
Vue.use(Buefy)

import App from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'
import Dashboard from './views/Dashboard'
import DashboardAddNew from './views/dashboard/DashboardAddNew'
import DashboardOffers from './views/dashboard/DashboardOffers'
import DashboardProfile from './views/dashboard/DashboardProfile'
import HeaderTop from './components/HeaderTopMenu'
import Sidebar from './components/Sidebar'
import myOffers from './components/MyOffers'
import ExtraData from './components/ExtraData'
import HeaderDashboard from './components/HeaderDasboard'
import Login from './components/Login'
import Form from './components/Form'
import Welcome from './components/Welcome'
import MyAccount from './components/MyAccount'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
Vue.component('vue2-dropzone', vue2Dropzone);
Vue.component('header-top', HeaderTop);
Vue.component('my-account', MyAccount);
Vue.component('my-offers', myOffers);
Vue.component('table-extra-data-row', ExtraData);
Vue.component('sidebar', Sidebar);
Vue.component('header-dashboard', HeaderDashboard);
Vue.component('main-form', Form);
Vue.component('header-login', Login);
Vue.component('welcome', Welcome);
Vue.component('multi-select', Multiselect);

var user = $('#details-helper').data('id');

const authMiddleware = (to, from, next) => {
    if (!user) {
        next = '/';
        window.location = "/";
    }

    return next();
}


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
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            beforeEnter: authMiddleware
        },

        {
            path: '/dashboard/add-new',
            name: 'addOffer',
            component: DashboardAddNew,
            beforeEnter: authMiddleware
        },

        {
            path: '/dashboard/my-offers',
            name: 'myOffer',
            component: DashboardOffers,
            beforeEnter: authMiddleware
        },
        {
            path: '/dashboard/my-offers',
            name: 'myOffer',
            component: DashboardOffers,
            beforeEnter: authMiddleware
        },

        {
            path: '/dashboard/my-profile',
            name: 'profile',
            component: DashboardProfile,
            beforeEnter: authMiddleware
        },


    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
