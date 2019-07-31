import Vue from 'vue';
import VueRouter from 'vue-router';
import vuetify from './plugins/vuetify.js';
import axios from 'axios';
import VueAxios from 'vue-axios';
import {
    store
} from './store/store';
import App from './components/App';
import TimeEntry from './components/TimeEntry';
import Page from './components/Page';
import Home from './components/Home';

Vue.use(VueRouter);
// Vue.use(Vuetify);
Vue.use(VueAxios, axios);

axios.defaults.baseURL = process.env.MIX_APP_BASE_URL;

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

//global axios interceptor to detect 401 unauthorised
// hopefully to stopedge case where auth time out not detected
axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    if (error.response.status === 401) {
        console.log('i am foo');
        location.reload();
        //throw new error(error);
    }
    return Promise.reject(error);
});

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/',
            name: 'home',
            component: Home,
            props: {
                title: "This is JKL home"
            }
        },
        {
            path: '/time-entry',
            name: 'timeEntry',
            component: TimeEntry,
            props: {
                title: "Time Entries"
            }
        },
        {
            path: '/spa-page',
            name: 'page',
            component: Page,
            props: {
                title: "This is the SPA Second Page",
                author: {
                    name: "Fisayo Afolayan",
                    role: "Software Engineer",
                    code: "Always keep it clean"
                }
            }
        },
    ],

});
const app = new Vue({
    el: '#fred',
    vuetify,
    store,
    components: {
        App
    },
    router,
    mounted() {}
});
