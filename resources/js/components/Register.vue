<template>
    <div class="d-flex justify-content-center align-items-center mt-5">

        <div class="card">
            <div class="card-header text-center">
                Register
            </div>
            <div class="card-body" style="width: 500px">
                <form>
                    <div class="alert alert-success" role="alert" v-if="msg !== ''">
                        {{msg}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <input type="text" :class="['form-control' ,errors.name ? 'is-invalid' : '']" v-model="user.name" aria-describedby="emailHelp">
                        <small   class="badge badge-danger p-1" v-if="errors.name">{{errors.name[0]}}</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email </label>
                        <input type="email" :class="['form-control' , errors.email ? 'is-invalid' :'']" v-model="user.email"  id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small  class="badge badge-danger p-1" v-if="errors.email">{{errors.email[0]}}</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" :class="['form-control' , errors.password ? 'is-invalid' :'']" v-model="user.password"  id="exampleInputPassword1">
                        <small class="badge badge-danger p-1" v-if="errors.email">{{errors.password[0]}}</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" :class="['form-control' , errors.password_confirmation ? 'is-invalid' : '']"  v-model="user.password_confirmation"  >
                        <small class="badge badge-danger p-1" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</small>

                    </div>

                    <button @click="registerUser" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data(){
            return{
                user:{
                    name:'',
                    email: '',
                    password:'',
                    password_confirmation:''
                },
                msg:'',
                errors:[]
            }
        },
        methods:{
            registerUser(){
                axios.post('api/registerUser',this.user).then(res => {
                    if(res.data.code === 200){
                        this.msg = res.data.msg ;
                        this.user = {
                            name:'',
                            email: '',
                            password:'',
                            password_confirmation:''
                        };
                        this.errors = [];
                    }else if(res.data.code === 400){
                        this.errors = [];
                        this.errors = res.data.data
                    }
                })
            }
        }
    }
</script>
