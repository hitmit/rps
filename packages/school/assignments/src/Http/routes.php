<?php

//Route::group(['middleware' => 'admin'], function () {

Route::resource('assignments', 'School\Assignments\Http\Controllers\AssignmentsController');
Route::get('assignments/{id}/confirm', [
    'as' => 'assignments.confirm',
    'uses' => 'School\Assignments\Http\Controllers\AssignmentsController@confirm',
]);

//});
