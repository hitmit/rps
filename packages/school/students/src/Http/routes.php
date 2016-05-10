<?php


//Route::group(['middleware' => 'admin'], function () {
    Route::resource('students', 'School\Students\Http\Controllers\StudentsController');
    Route::get('students/{id}/confirm', array(
      'as' => 'students.confirm',
      'uses' => 'School\Students\Http\Controllers\StudentsController@confirm',
    ));
//});