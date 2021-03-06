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

/**
 * Admin routes
 */
$router->group(['prefix' => $prefix, 'middleware' => 'auth:api'], function () use ($router) {
    $router->get('users/all', 'UserController@getAll');
});

/**
 * Authentication routes
 */
$router->group(['prefix' => $prefix], function () use ($router) {
    $router->post('users', 'UserController@add');
    $router->post('/auth/login', 'AuthController@postLogin');
});

/**
 *
 */
$router->group(['prefix' => $prefix], function () use ($router) {
    $router->post('users/{userId}/questions/add', 'UserController@addQuestion');
});


$router->group(['prefix' => $prefix, 'middleware' => ['auth:api', 'authorization']], function () use ($router) {
   $router->post('users/{userId}/questions/{questionId}', 'QuestionController@answerQuestion');
});

