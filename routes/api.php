<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    // login
    Route::post('/login', 'LoginController@login');
    // logout
    Route::post('/logout', 'LoginController@logout');

    Route::group(['middleware' => ['role']], function () {
        Route::group(['middleware' => ['check.field']], function () {
            // posts
            Route::get('/posts', 'PostController@index')->name('list_post');
            Route::get('/posts/{post_id}', 'PostController@show')->name('read_post');
            Route::post('/posts', 'PostController@create')->name('create_post');
            Route::put('/posts/{post_id}', 'PostController@update')->name('update_post');
            Route::delete('/posts/{post_id}', 'PostController@delete')->name('delete_post');
        });
    });
});
