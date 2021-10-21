
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
//import Vue from 'vue';
//import routers  from './routes';

Vue.use(VueRouter)
import Myheader from  './components/MyHeader'
import routes from "./routes";
const router = new VueRouter({
    //mode:'history',
    routes
  })


 const app = new Vue({
    el: '#hello',
    //routers,
    router,

    components :{
        Myheader
    }
});
