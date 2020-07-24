<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'StaticController@home')->name('static.home');
Route::get('/collection', 'CollectionController@index')->name('collection.index');

Route::get('/admin', 'AdminController@index')->name('admin.index');

foreach (config('lube.resources', []) as $resource) {
    $controller = 'Lube\\' . ucfirst($resource) . 'Controller';
    Route::get("/admin/$resource", "$controller@index")->name("lube.$resource.index");
    Route::get("/admin/$resource/create", "$controller@create")->name("lube.$resource.create");
    Route::get("/admin/$resource/{id}", "$controller@show")->name("lube.$resource.show");
    Route::get("/admin/$resource/{id}/edit", "$controller@edit")->name("lube.$resource.edit");
    Route::post("/admin/$resource/store", "$controller@store")->name("lube.$resource.store");
    Route::patch("/admin/$resource/{id}", "$controller@update")->name("lube.$resource.update");
    Route::get("/admin/$resource/{id}/delete", "$controller@delete")->name("lube.$resource.delete");
}

Auth::routes();
