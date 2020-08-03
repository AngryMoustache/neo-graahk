<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'StaticController@home')->name('static.home');

Route::middleware(CheckLogin::class)->group(function () {
    Route::get('/decks', 'DeckController@index')->name('decks.index');
    Route::get('/decks/{deck}', 'DeckController@edit')->name('decks.edit');
    Route::get('/decks/{deck}/duplicate', 'DeckController@duplicate')->name('decks.duplicate');
    Route::get('/decks/{deck}/delete', 'DeckController@delete')->name('decks.delete');

    Route::get('/game/browser', 'GameController@browser')->name('game.browser');
    Route::get('/game/{game}', 'GameController@game')->name('game.game');
});

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    foreach (config('lube.resources', []) as $resource) {
        $route = \Str::kebab($resource);
        $controller = 'Lube\\' . ucfirst(\Str::camel($resource)) . 'Controller';
        Route::get("/admin/$route", "$controller@index")->name("lube.$route.index");
        Route::get("/admin/$route/create", "$controller@create")->name("lube.$route.create");
        Route::get("/admin/$route/{id}", "$controller@show")->name("lube.$route.show");
        Route::get("/admin/$route/{id}/edit", "$controller@edit")->name("lube.$route.edit");
        Route::post("/admin/$route/store", "$controller@store")->name("lube.$route.store");
        Route::patch("/admin/$route/{id}", "$controller@update")->name("lube.$route.update");
        Route::get("/admin/$route/{id}/delete", "$controller@delete")->name("lube.$route.delete");
        Route::delete("/admin/$route/{id}/delete", "$controller@deleteCommit")->name("lube.$route.delete");
    }
});
