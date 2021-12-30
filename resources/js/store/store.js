import Vuex from 'Vuex';
import Vue from 'vue';
import axios from 'axios'
Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
      userData: null,
      count : 66
  },
  getters:{
    isLoged(state){
      return !! state.userData ;
    },
    getToken(state){
        return  state.userData ;

    }
  },
  mutations: {
    Set_USER_DATAT (state,data) {
        state.userData = data
        localStorage.setItem('user_JWT_Token', data)
       axios.defaults.headers.common.Authorization = `Bearer ${state.userData}`
    },
    REMOVE_USER_DATA(state){
        state.userData = null
        localStorage.removeItem('user_JWT_Token')
    }
  },
  actions:{
    login({commit} , userData){
    axios.post('api/login',userData).then(res => {
        commit('Set_USER_DATAT' , res.data.access_token)
        console.log(res.data.access_token)
    })

    }
  }
})
