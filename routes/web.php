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

/*$router->get('/', function () use ($router) {
    // return $router->app->version();
    echo "hello world";
});*/

$router->group(['prefix' => 'api/'], function () use ($router) {
    $router->get('test/','UsersController@test');
    $router->post('register/','UsersController@register');
    $router->post('login/','UsersController@authenticate');
    $router->get('todo/', 'TodoController@index');
    $router->post('add/','TodoController@store');
    $router->post('category/','CategoryController@store');
    $router->post('logout/','UsersController@logout');
    $router->delete('destroy/{id}','TodoController@destroy');
});
