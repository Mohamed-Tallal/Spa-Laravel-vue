<template>
    <div class="d-flex justify-content-center align-items-center mt-5">

        <div class="card">
            <div class="card-header text-center">
                Login
            </div>

            <div class="card-body" style="width: 500px">
                <div :class="['',error.msg ? 'alert alert-danger' : ''] " role="alert" >
                    {{error.msg}}
                </div>
                    <div class="form-group">
                        <label>Email address {{count}}</label>
                        <input type="email" :class="['form-control' , error.email ? 'is-invalid' : ''   ]"  v-model="user.email" aria-describedby="emailHelp">
                        <small v-if="error.email" id="emailHelp" class="form-text text-muted">{{error.email[0]}}</small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" :class="['form-control' , error.password ? 'is-invalid' : ''   ]"  v-model="user.password" >
                        <small v-if="error.password" class="form-text text-muted">{{error.password[0]}}</small>

                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" @click="login" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                user:{
                    password : '',
                    email : '',
                },
                error:[],
            }
        },
        computed:{
            count(){
                return this.$store.state.count

            }
        },
        methods:{
            login(){
                this.$store.dispatch('login' , this.user).then(()=>{
                    this.$router.push({name : 'postVue' })
                })
                console.log("getters state =  ")
                console.log(this.$store.getters.isLoged)

                /*
                then(()=>{
                    this.$router.push({name : 'postVue' })
                })
                axios.post('api/login',this.user).then(res=>{
                    if(res.data.code != 400 && res.data.code != 401 ){
                        localStorage.setItem('user_token' ,res.data.access_token )
                        this.user = {
                                    password : '',
                                    email : '',
                                 }
                                 this.error=[];
                        console.log(res.data.code)
                        Toast.fire({
                        icon: 'success',
                        title: 'Welcome Back .'
                        })
                    }else if(res.data.code === 401){
                        this.error = res.data.msg;
                    }
                    else{
                        this.error = res.data.msg;
                        console.log(res.data.msg)
                    }
                }).catch(error => {

                    console.log("There was an error!", error.data);
                });
                */

            }
        }
    }
</script>
