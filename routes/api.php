<?php
use Illuminate\Http\Request;
use App\Post;
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

Route::middleware('auth:api')->get('/posts', function (Request $request) {
    return $request->post();
    //$id = 1;
    //$posts = PostsController::show($id);
    //return postResource::collection($posts);
});
// gets all logins
Route::get('posts/{id}', 'PostsController@show');