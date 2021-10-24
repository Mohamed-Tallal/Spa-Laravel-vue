<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post ;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function getPosts()
    {
        $posts = Post::orderBy('id' ,'DESC')->paginate(5);
        return response()->json(['code' => 200 , 'status' => 'success','data' => $posts], 200);

    }

    public function createPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts,title|max:255',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400 , 'status' => 'validator error','data' => $validator->errors()], 200);
        }
      $post = new  Post;
      $post ->title = $request->title;
      $post ->desc = $request->desc;
      $post->save();
     return response()->json(['code' => 200 ,'msg' => 'Post added successfully', 'status' => 'success','data' => $post], 200);
    }



    public function showPost($id)
    {
        $post = Post::find($id);
            if($post){
                return response()->json(['code' => 200 ,'status' => 'success','data' => $post], 200);

            }else{
                return response()->json(['code' => 400 , 'status' => 'error found ','data' => 'nothing'], 200);
            }

    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $validator = Validator::make($request->all(), [
        'title' => 'required|unique:posts,title,'.$id.'|max:255',
        'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400 , 'status' => 'validator error','data' => $validator->errors()], 200);
        }
        if($post){
            $post->title = $request->title ;
            $post->desc = $request->desc ;
            $post->update();
            return response()->json(['code' => 200 ,'msg' => 'Update Post successfully', 'status' => 'success','data' => $post], 200);

        }else{
            return response()->json(['code' => 400 , 'status' => 'error found ','data' => 'nothing'], 200);
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if($post){
            $post->delete();
            return response()->json(['code' => 200 ,'msg' => 'Delete Post successfully','status' => 'success'], 200);

        }else{
            return response()->json(['code' => 400 , 'status' => 'error found ','data' => 'nothing'], 200);
        }
    }
}
