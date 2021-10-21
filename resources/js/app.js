
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
//import Vue from 'vue';
//import routers  from './routes';

Vue.use(VueRouter)
import Myheader from  './components/MyHeader'
import Login from  './components/Login'
import Post from  './components/Post'
import Register from  './components/Register'


const routes = [
    {
         path: '/loginVue',   
         name: 'Login',
         component : Login
    },
    { 
        path: '/postVue', 
        name: 'Post',
        component : Post 
    },
    {   path: '/registerVue',
        name: 'Register',
        component : Register 
    }
]

const router = new VueRouter({
     routes
  })


 const app = new Vue({
    el: '#hello',
    //routers,
    router,
    mode:'history',
    components :{
        Myheader
    }
});
