<?php

//Route::group(['middleware' => 'auth'], function () {

Route::resource('examlist', 'School\ExamList\Http\Controllers\ExamListController');
Route::get('examlist/{id}/confirm', [
    'as' => 'examlist.confirm',
    'uses' => 'School\ExamList\Http\Controllers\ExamListController@confirm',
]);

//});
