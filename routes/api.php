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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/posts', function(){
//     $posts = [
//         'title' => 'Laravel API',
//         'body' => 'Laravel Best API Course'
//     ];
//     return $posts;
// });

Route::group([
    'prefix' => 'auth',
], function(){
    Route::post('login', '\App\Http\Controllers\AuthController@login');
    Route::post('register', '\App\Http\Controllers\AuthController@register');
});

Route::resource('user', '\App\Http\Controllers\API\UserController');

Route::resource('price', '\App\Http\Controllers\API\DrugPriceController');

Route::resource('drugs', '\App\Http\Controllers\API\DrugController');