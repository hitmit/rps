<?php

//Route::group(['middleware' => 'auth'], function () {

Route::resource('subjects', 'School\Subjects\Http\Controllers\SubjectsController');
Route::get('subjects/{id}/confirm', [
    'as' => 'subjects.confirm',
    'uses' => 'School\Subjects\Http\Controllers\SubjectsController@confirm',
]);

//});