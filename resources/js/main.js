import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { store } from './store/store'
import App from './components/App'
import Wibble from './components/Wibble'
import Page from './components/Page'
import Home from './components/Home'

Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.use(VueAxios, axios);

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            props: { title: "This is JKL home" }
        },
        {
            path: '/wibble',
            name: 'wibble',
            component: Wibble,
            props: { title: "This is Wibble" }
        },
        {
            path: '/spa-page',
            name: 'page',
            component: Page,
            props: {
                title: "This is the SPA Second Page",
                author : {
                    name : "Fisayo Afolayan",
                    role : "Software Engineer",
                    code : "Always keep it clean"
                }
            }
        },
    ],

});
const app = new Vue({
    el: '#fred',
    store,
    components: { App },
    router,
    mounted () {
        this.axios.get('https://jsonplaceholder.typicode.com/users')
            .then(response => {
                this.info = response;
                console.log(this.info);
            });
    }
});
