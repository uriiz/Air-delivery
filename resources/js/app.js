
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

    },
})
Vue.use(Buefy)

import App from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'
import HeaderTop from './components/HeaderTopMenu'
import Login from './components/Login'
import Form from './components/Form'

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//Vue.component('header', require('./components/Header'));
Vue.component('header-top', HeaderTop);
Vue.component('main-form', Form);
Vue.component('header-login', Login);
Vue.component('multi-select', Multiselect);

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
