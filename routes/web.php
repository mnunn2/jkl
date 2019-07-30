<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// removed {any} from after the route as api fallback route doesn't work
Route::get('/', function(){
    return view('jklapp');
})->middleware('auth');

Route::get('/{spa}', function(){
    return view('jklapp');
})->where('spa', 'admin|spa-page')->middleware('auth');

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/jkl', function () {
//    return view('jklapp');
//});

// Route::get('/home', 'HomeController@index')->name('home');




