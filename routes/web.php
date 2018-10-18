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
    return view('welcome');
});

$router->get('/users', 'UserController@index');
$router->post('/users', 'UserController@store');
$router->get('/users/{id}', 'UserController@show');
$router->put('/users/{id}', 'UserController@update');
$router->delete('/users/{id}', 'UserController@destroy');
