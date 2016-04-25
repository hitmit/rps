<?php

//Route::group(['middleware' => 'auth'], function () {

Route::resource('dormitory', 'School\Dormitory\Http\Controllers\DormitoryController');
Route::get('dormitory/{id}/confirm', [
    'as' => 'dormitory.confirm',
    'uses' => 'School\Dormitory\Http\Controllers\DormitoryController@confirm',
]);

//});