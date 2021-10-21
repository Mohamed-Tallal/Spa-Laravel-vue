<template>
    <div>

<hr>
        <div class="alert alert-success mb-3" role="alert" v-if="msg !== ''">
           {{msg}}
        </div>

        <div class="row">
            <div class="col col-md-12 mb-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">
                    Add Post
                </button>
            </div>
            <div class="col-sm-8" v-for="item in posts" :key="item.id">
                    <div class="card-body">
                        <h3 class="card-title">{{item.title}}</h3>
                        <p class="card-text">
                            {{item.desc}}
                        </p>
                    </div>
            </div>
        </div>




        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add a new Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tittle</label>
                                <input type="email" :class="['form-control' ,validate.title ? 'is-invalid' : '' ]" v-model="post.title" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <small class="badge badge-danger text-white" v-if="validate.title">{{validate.title[0]}} </small>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description </label>
                                <textarea :class="['form-control' ,validate.desc ? 'is-invalid' : '' ]"  v-model="post.desc" id="exampleFormControlTextarea1" rows="3"></textarea>
                                <small class="badge badge-danger text-white" v-if="validate.desc">{{validate.desc[0]}} </small>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" @click="createPost">Save </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default{
    data(){
        return{
            post:{
                id : "",
                title : "",
                desc : ""
            },
            validate:[],
            msg:'',
            posts : []
        }
    },
  methods: {
       createPost(){
           axios.post('api/createPost' , this.post).then(res => {
               if(res.data.code === 200){
                   this.post = res.data.data
                   this.msg = res.data.msg
                   $("#exampleModal .close").click();
                   this.post = {
                       id : "",
                       title : "",
                       desc : ""
                   }
                   this.getPosts();

               }else if(res.data.code === 400){
                   this.validate  = res.data.data;
                   console.log(this.validate);
               }
           })
       },
      getPosts(){
           axios.get('api/getPosts').then(res => {
              this.posts = res.data.data;
              console.log(this.posts)
           });
      }

  },
    created() {
        this.getPosts()
        console.log(this.posts)
    }
}


</script>
