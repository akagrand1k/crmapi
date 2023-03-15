<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
//['namespace'=>'App\Http\Controllers',
Route::group( ['middleware' => 'guest'], function () {

    //Route::get('/test/exportdb', [TestController::class]);
    //Route::get('/test/schools', 'TestController@schools']);
    Route::get('/test3',        'TestController@test3');
    Route::get('/db-test',      'QueryController@test');
    Route::get('/factory',      'cSeeds@run');

});
