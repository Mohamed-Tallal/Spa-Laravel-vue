<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::post('createPost', 'PostController@createPost')->name('createPost.post');
Route::get('getPosts', 'PostController@getPosts')->name('getPosts');
Route::get('showPost/{id}', 'PostController@showPost')->name('showPost');
Route::post('updatePost/{id}', 'PostController@update')->name('updatePost');
Route::post('deletePost/{id}', 'PostController@destroy')->name('deletePost');
Route::post('registerUser', 'UserController@registerUser')->name('registerUser');
