<?php

use Illuminate\Support\Facades\Route;

Route::post('/deck-builder/page', 'Api\DeckBuilderController@page');
Route::post('/deck-builder/save', 'Api\DeckBuilderController@save');

Route::post('/game/start', 'Api\GameController@start');
Route::post('/game/update-board', 'Api\GameController@updateBoard');

Route::get('/pusher-message/{id}', 'Api\PusherMessageController');
