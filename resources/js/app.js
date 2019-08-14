
require('./bootstrap');
require('./particiles');
require('./functions');
window.Vue = require('vue');
import VueRouter from 'vue-router'
import VueCircle from 'vue2-circle-progress'
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
import DashboardApp from './views/app/Dashboard'
import DashboardAddNew from './views/dashboard/DashboardAddNew'
import DashboardOffers from './views/dashboard/DashboardOffers'
import DashboardAdmin from './views/admin/Dashboard'
import DashboardShipper from './views/admin/DashboardShipper'
import DashboardWaiting from './views/admin/DashboardWaiting'
import DashboardFeeds from './views/admin/DashboardFeeds'
import DashboardConfirm from './views/admin/DashboardConfirm'
import DashboardProfile from './views/dashboard/DashboardProfile'
import DashboardOffer from './views/dashboard/DashboardOffer'
import HeaderTop from './components/HeaderTopMenu'
import DashboardUser from './components/DashboardUser'
import AppLoginC from './components/app/AppLogin'
import AdminSideBar from './components/admin/SideBar'
import OfferApp from './components/app/OfferApp'
import SetOffer from './components/app/SetOffer'
import FormSingle from './components/FormSingle'
import DeleteSvg from './components/svg/Delete'
import ExtraDataPrice from './components/ExtraDataPrice'
import Sidebar from './components/Sidebar'
import SidebarApp from './components/app/Sidebar'
import EditApp from './components/app/Edit'
import myOffers from './components/MyOffers'
import ShowPrice from './components/ShowPrice'
import ExtraData from './components/ExtraData'
import HeaderDashboard from './components/HeaderDasboard'
import Login from './components/Login'
import LoginApp from './views/app/Login'
import DashboardFinalStep from './views/app/DashboardFinalStep'
import appDashboardEdit from './views/app/Profile'
import Form from './components/Form'
import Welcome from './components/Welcome'
import MyAccount from './components/MyAccount'
import ConfirmSvg from './components/svg/Confirm'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import VueCarousel from '@chenfengyuan/vue-carousel';
Vue.component('vue2-dropzone', vue2Dropzone);
Vue.component(VueCarousel.name, VueCarousel);
Vue.component('header-top', HeaderTop);
Vue.component('my-account', MyAccount);
Vue.component('vue-circle', VueCircle);
Vue.component('my-offers', myOffers);
Vue.component('app-edit', EditApp);
Vue.component('app-loginc', AppLoginC);
Vue.component('table-extra-data-row', ExtraData);
Vue.component('sidebar', Sidebar);
Vue.component('offer-app', OfferApp);
Vue.component('set-offer', SetOffer);
Vue.component('show-price', ShowPrice);
Vue.component('sidebar-app', SidebarApp);
Vue.component('header-dashboard', HeaderDashboard);
Vue.component('main-form', Form);
Vue.component('main-form-single', FormSingle);
Vue.component('extra-data-price', ExtraDataPrice);
Vue.component('header-login', Login);
Vue.component('dashboard-user', DashboardUser);
Vue.component('welcome', Welcome);
Vue.component('admin-sidebar', AdminSideBar);
Vue.component('delete-svg', DeleteSvg);
Vue.component('confirm-svg', ConfirmSvg);
Vue.component('multi-select', Multiselect);

var user = $('#details-helper').data('id');
var role = $('#details-helper').data('r');

const authMiddleware = (to, from, next) => {
    if (!user) {
        next = '/';
        window.location = "/";
    }
    if(role != 1){
        next = '/';
        window.location = "/";
    }
    return next();
}
const authMiddlewareShip = (to, from, next) => {
    if (!user) {
        next = '/';
        window.location = "/";
    }
    if(role != 2){
        next = '/';
        window.location = "/";
    }
    return next();
}

const authMiddlewareAdmin = (to, from, next) => {
    if (!user) {
        next = '/';
        window.location = "/";
    }
    if(role != 3){
        next = '/';
        window.location = "/";
    }
    return next();
}

const loginStatus = (to, from, next) => {
    if (user) {
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
        {
            path: '/dashboard/offer/:id',
            name: 'offer',
            component: DashboardOffer,
            beforeEnter: authMiddleware
        },
        {
            path: '/app-login',
            name: 'appLogin',
            component: LoginApp,
            beforeEnter: loginStatus
        },
        {
            path: '/app-dashboard',
            name: 'appDashboard',
            component: DashboardApp,
            beforeEnter: authMiddlewareShip
        },
        {
            path: '/app-dashboard/edit',
            name: 'appDashboardEdit',
            component: appDashboardEdit,
            beforeEnter: authMiddlewareShip
        },


        {
            path: '/app-dashboard/confirmed',
            name: 'DashboardFinalStep',
            component: DashboardFinalStep,
            beforeEnter: authMiddlewareShip
        },



        {
            path: '/admin-dashboard',
            name: 'DashboardAdmin',
            component: DashboardAdmin,
            beforeEnter: authMiddlewareAdmin
        },

        {
            path: '/admin-dashboard-shipper',
            name: 'DashboardShipper',
            component: DashboardShipper,
            beforeEnter: authMiddlewareAdmin
        },
        {
            path: '/admin-waiting-shipper',
            name: 'DashboardWaiting',
            component: DashboardWaiting,
            beforeEnter: authMiddlewareAdmin
        },

        {
            path: '/admin-confirm',
            name: 'DashboardConfirm',
            component: DashboardConfirm,
            beforeEnter: authMiddlewareAdmin
        },

        {
            path: '/admin-feeds',
            name: 'DashboardFeeds',
            component: DashboardFeeds,
            beforeEnter: authMiddlewareAdmin
        },

    ],
});

import {store} from './store'

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store,
});
