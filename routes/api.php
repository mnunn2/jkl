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

Route::get('workers', 'API\WorkerController@index'); //->middleware('auth:api');
Route::get('worker/{worker}', 'API\WorkerController@show');

//Route::apiResources([
//    'workers' => 'API\WorkerController'
//]);


