<template>
    <div>
        <div class="d-flex justify-content-center mt-3 ">
            <router-link class="mr-3" v-if="!isLoged" to="/registerVue">Register</router-link>
            <router-link class="mr-3" v-if="!isLoged" to="/loginVue">Login</router-link>
            <router-link class="mr-3" v-if="isLoged" to="/postVue">Post</router-link>
            <a class="mr-3" v-if="isLoged" @click="logout" >Logout</a>
        </div>
        <hr>
    </div>
</template>
<script>
export default {
    data() {
        return {
           // isLoged : false
        }
    },
    created(){

    },methods:{
        logout(){
            this.$store.commit("REMOVE_USER_DATA")
            this.$router.push({name : 'loginVue' })

        }
    },
    computed:{
        isLoged(){
            return this.$store.getters.isLoged

        }
    }

}
</script>



