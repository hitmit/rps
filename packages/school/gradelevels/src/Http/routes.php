<?php


//Route::group(['middleware' => 'admin'], function () {
Route::resource('gradelevels', 'School\GradeLevels\Http\Controllers\GradeLevelsController');
Route::get('gradelevels/{id}/confirm', array(
    'as' => 'gradelevels.confirm',
    'uses' => 'School\GradeLevels\Http\Controllers\GradeLevelsController@confirm',
));

//});
