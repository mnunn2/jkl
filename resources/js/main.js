import Vue from 'vue'
import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import App from './components/App'
import Wibble from './components/Wibble'
import Page from './components/Page'
import Home from './components/Home'

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);

axios.defaults.headers.common = {
  "X-Requested-With": "XMLHttpRequest",
  "X-CSRFToken": "example-of-custom-header"
};

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
