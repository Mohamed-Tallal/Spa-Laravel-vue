
import Axios from 'axios'
import Login from  './components/Login'
import Post from  './components/Post'
import Register from  './components/Register'


const routes = [
    {
        path: '/loginVue',
        name: 'loginVue',
        component : Login
    },
    {
        path: '/postVue',
        name: 'postVue',
        component : Post,
        beforeEnter: (to, from, next) => {
            Axios.post('api/auth/me').then(() =>{
                next();
            }).catch(()=>{
                return next({name : "loginVue" })
            })
        }
        /**
         *
         * meta: { requiresAuth: true }
         * beforeEnter: (to, from, next) => {
            Axios.post('api/auth/me').then(() =>{
                next();
            }).catch(()=>{
                return next({name : "loginVue" })
            })
        }
         */
    },
    {   path: '/registerVue',
        name: 'registerVue',
        component : Register
    }
]

/****
 *
 *
 routes.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!store.getters.getAuth) {
          next({ name: 'Login' })
        } else {
           next();
        }
      } else {
        next()
      }
});
 */

export default routes


