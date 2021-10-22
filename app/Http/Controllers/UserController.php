<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function registerUser(Request $request){
        $validator =Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);
        if ($validator->fails()){
            return response()->json(['code' => 400 , 'status' => 'validator error','data' => $validator->errors()], 200);
        }
        $user = new  User;
        $user->name = $request->name ;
        $user->email = $request->email ;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['code' => 200 ,'msg' => 'You are Register Now', 'status' => 'success','data' => $user], 200);
    }
}
