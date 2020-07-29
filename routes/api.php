<?php

use Illuminate\Support\Facades\Route;

Route::post('/deck-builder/page', 'Api\DeckBuilderController@page');
Route::post('/deck-builder/save', 'Api\DeckBuilderController@save');
