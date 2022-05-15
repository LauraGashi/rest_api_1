<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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


$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

   $router->group(['middleware' => 'auth'], function () use ($router) {
       // User Endpoints
       $router->get('/users', 'UserController@index');
       $router->post('/users', 'UserController@store');
       $router->put('/users/{id}', 'UserController@update');
       $router->delete('/users/{id}', 'UserController@destroy');

       // User_Details Endpoints
       $router->get('/user_details', 'UserDetailController@index');
       $router->post('/user_details', 'UserDetailController@store');
       $router->put('/user_details/{id}', 'UserDetailController@update');
       $router->delete('/user_details/{id}', 'UserDetailController@destroy');

       // Post Endpoints
       $router->get('/posts', 'PostController@index');
       $router->post('/posts', 'PostController@store');
       $router->put('/posts/{id}', 'PostController@update');
       $router->delete('/posts/{id}', 'PostController@destroy');

       // Reply Endpoints
       $router->get('/replies', 'ReplyController@index');
       $router->post('/replies', 'ReplyController@store');
       $router->put('/replies/{id}', 'ReplyController@update');
       $router->delete('/replies/{id}', 'ReplyController@destroy');

       // Logout
       $router->post('/logout', 'AuthController@logout');
   });


});
