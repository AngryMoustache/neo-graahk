<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'StaticController@home')->name('static.home');

Route::middleware(CheckLogin::class)->group(function () {
    Route::get('/decks', 'DeckController@index')->name('decks.index');
    Route::get('/decks/new', 'DeckController@new')->name('decks.new');
    Route::get('/decks/{deck}', 'DeckController@edit')->name('decks.edit');
    Route::get('/decks/{deck}/duplicate', 'DeckController@duplicate')->name('decks.duplicate');
    Route::get('/decks/{deck}/delete', 'DeckController@delete')->name('decks.delete');
});

Route::middleware(AdminMiddleware::class)->group(function () {
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
        Route::delete("/admin/$resource/{id}/delete", "$controller@deleteCommit")->name("lube.$resource.delete");
    }
});
