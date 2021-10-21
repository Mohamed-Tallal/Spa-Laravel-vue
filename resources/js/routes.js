
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
        component : Post
    },
    {   path: '/registerVue',
        name: 'registerVue',
        component : Register
    }
]
export default routes
