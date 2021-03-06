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

Route::middleware('auth:api')->group(function () {

    // Worker routes:
    Route::get('workers', 'API\WorkerController@index');
    Route::post('worker', 'API\WorkerController@store');
    Route::get('worker/{worker}', 'API\WorkerController@show');

    // Worker - Job routes
    Route::get('worker/{worker}/jobs', 'API\WorkerController@getWorkerJobs');
    Route::post('worker/{worker}/job/{jobId}', 'API\WorkerController@postWorkerJob');
    Route::delete('worker/{worker}/job/{jobId}', 'API\WorkerController@deleteWorkerJob');

    // Job routes:
    Route::get('jobs', 'API\JobController@index');

    // Project routes:
    Route::get('projects', 'API\ProjectController@index');
    Route::get('projects/{project}/jobs', 'API\ProjectController@getProjectJobs');

    // TimeEntry routes:
    Route::get('time-entries', 'API\TimeEntryController@index');
    Route::post('time-entry', 'API\TimeEntryController@store');
    Route::delete('time-entry/{id}', 'API\TimeEntryController@destroy');

});

Route::fallback(function(){
    return response()->json(['message' => 'Resource not Found!'], 404);
});


//Route::get('workers', 'API\WorkerController@index')->middleware('auth:api');
//Route::get('worker/{worker}', 'API\WorkerController@show');

//Route::apiResources([
//    'workers' => 'API\WorkerController'
//]);


