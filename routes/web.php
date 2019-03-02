<?php
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/helloword', function () use ($router) {
    return "Hello Word!!";
});
//usuarios

  $router->post('/user',["uses"=> "ExampleController@crateUser"]);
  $router->post('/login',["uses"=> "ExampleController@login"]);
  $router->group(['middleware' => ['auth']], function() use ($router){
    $router -> get('/users',["uses" => "ExampleController@index"]);
    $router -> get('/user/{id}',["uses" => "ExampleController@getUser"]);
    $router -> delete('/user/{id}',["uses"=>"ExampleController@deleteUser"]);
    $router -> put('/user/{id}',["uses"=>"ExampleController@updateUser"]);
  });
  $router->post('/noc',["uses"=> "ExampleController@nocb"]);

//post
  $router->get('/post',["uses"=> "PostController@index"]);
  //create
    $router->post('/post',["uses"=> "PostController@createPost"]);
  //read
    $router->get('/posts',["uses"=> "PostController@getPost"]);
    $router->get('/post/{id}',["uses"=> "PostController@getPostbyID"]);
    $router->get('/posts/{id}',["uses"=> "PostController@getPostbyUser_ID"]);
    $router->get('/postu/{id}',["uses"=> "PostController@getPostbyUser_ID"]);
  //update
    $router->put('/post/{id}',["uses"=> "PostController@updatePost"]);
  //delete
    $router->delete('/post/{id}',["uses"=> "PostController@deletePost"]);

//comentario
  //create
    $router->post('/coment',["uses"=> "ComentsController@createComent"]);
  //read
    $router->get('/coments',["uses"=> "ComentsController@getComent"]);
    $router->get('/coment/{id}',["uses"=> "ComentsController@getComentbyID"]);
    // $router->get('/coments/{id}',["uses"=> "ComentsController@getComentbyUser_ID"]);
    $router->get('/coments/{id}',["uses"=> "ComentsController@getComentbyPost_ID"]);
  //update
    $router->put('/coment/{id}',["uses"=> "ComentsController@updateComent"]);
  //delete
    $router->delete('/coment/{id}',["uses"=> "ComentsController@deleteComent"]);

//likes
   //create
    $router->post('/like',["uses"=> "LikesController@createLike"]);
   //read
    $router->get('/likes',["uses"=> "LikesController@getLike"]);
    $router->get('/like/{id}',["uses"=> "LikesController@getLikebyID"]);
    $router->get('/likeU/{id}',["uses"=> "LikesController@getLikebyUser_ID"]);
    $router->get('/likeP/{id}',["uses"=> "LikesController@getLikebyPost_ID"]);
    $router->get('/likeC/{id}',["uses"=> "LikesController@getLikebyComent_ID"]);
   //update
    $router->put('/like/{id}',["uses"=> "LikesController@updateLike"]);
   //delete
    $router->delete('/like/{id}',["uses"=> "LikesController@deleteLike"]);
