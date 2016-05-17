<?php


//Route::group(['middleware' => 'admin'], function () {
    Route::get('students/search', [
      'as' => 'students.search',
      'uses' => 'School\Students\Http\Controllers\StudentsController@search',
    ]);
    Route::resource('students', 'School\Students\Http\Controllers\StudentsController');
    Route::get('students/{id}/confirm', array(
      'as' => 'students.confirm',
      'uses' => 'School\Students\Http\Controllers\StudentsController@confirm',
    ));



//});
