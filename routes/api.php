<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
});



Route::match(['get','post'],'store-pokemon','PokemonController@store');
Route::match(['get','post'],'trianer-pokemon/{id}','PokemonController@getPokemon');
Route::match(['get','post'],'listusers','UserController@getAllUsers');
Route::match(['get','post'],'trainer-update','AuthController@updateDetails');


