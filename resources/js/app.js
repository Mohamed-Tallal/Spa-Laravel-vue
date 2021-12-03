
require('./bootstrap');
import Vue from 'vue';

window.Vue = require('vue');
import VueRouter from 'vue-router';

import VueLoading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
//import Vue from 'vue';
//import routers  from './routes';
Vue.use(VueLoading);
Vue.use(VueRouter)
Vue.component('pagination', require('laravel-vue-pagination'));

import Myheader from  './components/MyHeader'
import MyTem from  './components/Tem.vue'
import routes from "./routes";

const router = new VueRouter({
    mode:'history',
    routes
})

 const app = new Vue({
    el: '#hello',
    //routers,
    router,
    components :{
        Myheader,
        MyTem
    }
});
