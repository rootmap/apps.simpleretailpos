<?php

use Illuminate\Support\Facades\Route;

// All loyalty related routes goes here...
Route::get('/','MainController@index' );
Route::get('/my-loyalty/{message}','MainController@show' );
// Route::get('/other-loyalty','Other\LoyaltyController@index' );

