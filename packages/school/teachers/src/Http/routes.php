<?php


//Route::group(['middleware' => 'admin'], function () {
    Route::resource('teachers', 'School\Teachers\Http\Controllers\TeachersController');
    Route::get('teachers/{id}/confirm', array(
      'as' => 'teachers.confirm',
      'uses' => 'School\Teachers\Http\Controllers\TeachersController@confirm',
    ));
//});