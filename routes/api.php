<?php

//herkese açık route
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('addrecord', 'SensorController@kayitekle');
Route::get('adddata', 'SensorController@dataadd');
Route::get('searchmongo', 'SensorController@mongoConnect');
Route::post('insertmongo', 'SensorController@mongoinsert');

//auth yapılmış routeler
Route::group(['middleware' => 'auth:api'], function () {
   Route::get('deneme', 'UserController@deneme');
   Route::post('/sensors', 'UserController@sensors');
});

