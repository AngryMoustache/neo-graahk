<?php

use Illuminate\Support\Facades\Route;

Route::post('/deck-builder/save', 'Api\DeckBuilderController@save');

Route::post('/game/start', 'Api\GameController@start');
Route::post('/game/update-data', 'Api\GameController@updateData');
Route::post('/game/fire-event', 'Api\GameController@fireEvent');

Route::get('/pusher-message/{id}', 'Api\PusherMessageController');
