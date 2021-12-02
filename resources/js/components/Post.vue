<template>
    <div>

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
</div>
        <div v-for="item in posts.data" :key="item.id">
             <div class="row border m-3" >
            <div class="col-sm-10" >
                    <div class="card-body">
                        <h3 class="card-title">{{item.title}}</h3>
                        <p class="card-text">
                            {{item.desc}}
                        </p>
                    </div>
            </div>
            <div class="col col-md-2  mt-5">
                <div class="d-flex justify-content-center text-center">
                    <button type="button" class="btn btn-warning btn-sm mr-2 " @click="showPost(item.id)" data-toggle="modal" data-target="#exampleModal1">Update</button>
                    <button type="button"  @click="deletePost(item.id)" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </div>
        </div>

        <pagination :data="posts" @pagination-change-page="getPosts"></pagination>


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
                                <input type="email" :class="['form-control' ,validate.title ? 'is-invalid' : '' ]" v-model="post.title" id="exampleInputEmail" aria-describedby="emailHelp">
                                <small class="badge badge-danger text-white" v-if="validate.title">{{validate.title[0]}} </small>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description </label>
                                <textarea :class="['form-control' ,validate.desc ? 'is-invalid' : '' ]"  v-model="post.desc" id="exampleFormControlTextarea" rows="3"></textarea>
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


        <!----- create post ---->

        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Post</h5>
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
                        <button type="button" class="btn btn-success" @click="updatePost(post.id)">Save </button>
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
            posts : [],
            postDetails : {
                id : "",
                title : "",
                desc : ""
            }

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
                   this.validate = [];
                   this.getPosts();

               }else if(res.data.code === 400){
                   this.validate  = res.data.data;
                   console.log(this.validate);
               }
           })
       },
      getPosts(page = 1){
           axios.get('api/getPosts?page=' + page).then(res => {
              this.posts = res.data.data;
              console.log(this.posts)
           });
      },
      showPost(id){
          axios.get('api/showPost/'+id).then(res => {
              this.post = res.data.data
              if(this.validate !== []  ){
                  this.validate = [];
              }
          });
      },
      updatePost(id){
          axios.post('api/updatePost/'+id , this.post).then(res => {
              if(res.data.code === 200){
                 // this.post = res.data.data
                  this.msg = res.data.msg
                  $("#exampleModal1 .close").click();
                  this.post = {
                      id : "",
                      title : "",
                      desc : ""
                  }
                  this.validate = [];
                  this.getPosts();

              }else if(res.data.code === 400){
                  this.validate  = res.data.data;
                  console.log(this.validate);
              }
          });
      },
      deletePost(id){
          axios.post('api/deletePost/'+id ).then(res => {
              if(res.data.code === 200){
                  this.msg = res.data.msg
                  this.getPosts();
              }
          })
      }
  },
    created() {
        this.getPosts()
        console.log(this.posts)
    }
}


</script>
