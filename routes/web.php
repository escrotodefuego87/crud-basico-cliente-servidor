<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/holamundo', function(){return "Hola Mundo";});

$router->get('/hola', ["uses" => "ExampleController@index"]);

$router->post('/createUser',["uses"=>"UserController@createUser"]);

$router->group(['middleware'=>['auth']], function() use($router){
	$router->get('/holaController',["uses" => "UserController@index"]);
});
$router->get('/user/{id}', ["uses"=>"UserController@getUser"]);

$router->delete('/user/{id}', ["uses"=>"UserController@deleteUser"]);

$router->put('/user/{id}', ["uses"=>"UserController@updateUser"]);
    
//////////////////POST
$router->post('/post', ["uses" => "PostController@createPost"]);

$router->post('/postfile', ["uses" => "PostController@uploadFile"]);

$router->get('/post', ["uses" => "PostController@getPosts"]);

$router->get('/post/{id}', ["uses" => "PostController@getPostsbyID"]);

$router->get('/postid/{UserId}', ["uses" => "PostController@getPostbyUserID"]);

$router->put('/post/{id}', ["uses" => "PostController@updatePost"]);

$router->delete('/post/{id}', ["uses" => "PostController@deletePost"]);

////////////////////COMMENTS

$router->post('/comment', ["uses" => "CommentController@createComment"]);

$router->get('/comment', ["uses" => "CommentController@getComments"]);

$router->get('/comment/{id}', ["uses" => "CommentController@getCommentbyID"]);

$router->get('/commentid/{UserId}', ["uses" => "CommentController@getCommentbyUserID"]);

$router->put('/comment/{id}', ["uses" => "CommentController@updateComment"]);

$router->delete('/comment/{id}', ["uses" => "CommentController@deleteComment"]);

///////////////////LIKES

$router->post('/likeP',["uses"=>"LikeController@createPostLike"]);

$router->post('/likeC',["uses"=>"LikeController@createCommentLike"]);

$router->get('/likes',["uses"=>"LikeController@getPostsLike"]);

$router->get('/likes',["uses"=>"LikeController@getCommentsLike"]);

$router->get('/likes/{id}',["uses"=>"LikeController@getPostbyLike"]);

$router->get('/likesU/{id}',["uses"=>"LikeController@getPostbyUserIDLike"]);

$router->get('/likesPN/{id}',["uses"=>"LikeController@getLikesNumberP"]);

$router->get('/likesPC/{id}',["uses"=>"LikeController@getLikesNumberC"]);