<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'StaticController@home')->name('static.home');
Route::get('/collection', 'CollectionController@index')->name('collection.index');

Auth::routes();
