<?php

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => '/v1'], function() {
    Route::post('/books', 'BookController@store');
    Route::get('/books{name?&}{country?&}{publisher?&}{release_date?}', 'BookController@index');
    Route::get('/books/{id}', 'BookController@show');
    Route::delete('/books/{id}', 'BookController@delete');
    Route::patch('/books/{id}', 'BookController@update');
});

Route::get('/external-book{name?}', 'BookController@external');