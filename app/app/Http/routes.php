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

$app->get('/', function () use ($app) {
    return response()->json(['data' => ['status' => 'online']]);
});

$app->group(['prefix' => 'user'], function () use ($app) {
    $app->get('/', '\App\Http\Controllers\UserController@index');
    $app->get('/{id}', '\App\Http\Controllers\UserController@view');
    $app->post('/', '\App\Http\Controllers\UserController@store');
    $app->put('/{id}', '\App\Http\Controllers\UserController@update');
    $app->delete('/{id}', '\App\Http\Controllers\UserController@delete');
});
