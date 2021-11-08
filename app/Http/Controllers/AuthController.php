<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|exists:users,email' ,
            'password' => 'required|string' ,
        ]);
        if ($validator->fails()){
           // 'success','data' => $post], 200
            return response()->json(['code' => 400 ,'status' =>'error' ,'msg' => $validator->errors()->all() ], 200);
        }
        $credentials = request(['email', 'password']);
        if (! $token_user = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['code' => 401 ,'status' =>'error','msg' => ['Unauthorized']], 200);
        }
        return $this->respondWithToken($token_user);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->guard('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('api')->user()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('api')->user()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'code' => 200 ,
            'status' =>'success' ,
            'access_token' => $token,
            'user_data' => auth()->guard('api')->user(),
            'expires_in' => 60
        ]);
    }
}
