<?php

use Illuminate\Support\Facades\Route;

Route::post('/deck-builder/page', 'Api\DeckBuilderController@page')
    ->name('deck-builder.page');
