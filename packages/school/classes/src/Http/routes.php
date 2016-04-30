<?php
//Route::group(['middleware' => 'auth'], function () {

Route::resource('classes', 'School\Classes\Http\Controllers\ClassesController');

Route::get('classes/{id}/confirm', [
    'as' => 'classes.confirm',
    'uses' => 'School\Classes\Http\Controllers\ClassesController@confirm',
]);

//});