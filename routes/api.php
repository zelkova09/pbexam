<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpensesController;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix'=>'auth'], function(){
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('profile', 'AuthController@profile');
    });
});

// Route::group(['middleware' => 'auth:api'], function () {
//     Route::group(['middleware' => 'scope:user'], function () {
//         Route::get('get-categories', 'ProductController@categories');
//         Route::resource('products', 'ProductController');
//     });

Route::resource('expenses','ExpensesController');