
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
    },
    {   path: '/registerVue',
        name: 'registerVue',
        component : Register
    }
]

export default routes


