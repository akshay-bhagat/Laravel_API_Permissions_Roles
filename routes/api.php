<?php

use Illuminate\Http\Request;

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

Route::get('/users', function ()
{
    $users = App\User::with('roles')->get();
    return $users;
});

Route::post('/apiLogin', 'API\AuthController@login');

Route::middleware(['auth:api'])->group(function ()
{
    
    Route::get('/user-list', 'API\UserController@index')->middleware('scope:access-route1,view-user');
    Route::get('/route1', 'API\UserController@route1')->middleware('scope:access-route1');
    Route::get('/route2', 'API\UserController@route2')->middleware('scope:access-route2');
    Route::post('/user-delete', 'API\UserController@destroy')->middleware('scope:delete-user,access-route1');

});