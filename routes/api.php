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

Route::middleware(['cors', 'json.response', 'auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // public routes
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register', 'Auth\ApiAuthController@register')->name('register.api');

    // Protected Routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/articles', 'ArticleController@index')->name('articles.index');
        Route::get('/articles/{id}', 'ArticleController@show')->name('articles.show');
        Route::post('/articles', 'ArticleController@store')->name('articles.store');
        Route::put('/articles/{id}', 'ArticleController@update')->name('articles.update');
        Route::delete('/articles/{id}', 'ArticleController@destroy')->name('articles.destroy');
        Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    });
});


