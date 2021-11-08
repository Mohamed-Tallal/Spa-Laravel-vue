<template>
    <div class="d-flex justify-content-center align-items-center mt-5">

        <div class="card">
            <div class="card-header text-center">
                Login
            </div>

            <div class="card-body" style="width: 500px">
                <div :class="['',error !== []  ? 'alert alert-danger' : ''] " role="alert" >
                    {{error[0]}}
                </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" v-model="user.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" v-model="user.password" class="form-control" id="exampleInputPassword1">
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
        methods:{
            login(){
                console.log(this.user)

                axios.post('api/login',this.user).then(res=>{
                    if(res.data.code != 400 && res.data.code != 401 ){
                        localStorage.setItem('user_token' ,res.data.access_token )
                        this.user = {
                                    password : '',
                                    email : '',
                                 }
                        console.log(res.data.code)

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
            }
        }
    }
</script>
