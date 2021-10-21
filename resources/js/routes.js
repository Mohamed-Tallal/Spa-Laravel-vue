
import Vue from 'vue'
import VueRouter from 'vue-router'

import LoginComponents from  './components/Login'
import PostComponents from  './components/Post'
import RegisterComponents from  './components/Register'

Vue.use(VueRouter)

const routes = [
    {
         path: '/login',   
         name: 'Login',
         component : LoginComponents
    },
    { 
        path: '/post', 
        name: 'Post',
        component : PostComponents 
    },
    {   path: '/register',
        name: 'Register',
        component : RegisterComponents 
    }
]

const router = VueRouter({
    mode:'history' ,
    routes
})


export default router

