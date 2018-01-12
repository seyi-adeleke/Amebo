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


$prefix = 'api/v1';

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => $prefix], function () use ($router) {
    $router->post('users', 'UserController@add');
});