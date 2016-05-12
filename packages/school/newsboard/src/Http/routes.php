<?php

//Route::group(['middleware' => 'auth'], function () {

Route::resource('newsboard', 'School\Newsboard\Http\Controllers\NewsBoardController');
Route::get('newsboard/{id}/confirm', [
    'as' => 'newsboard.confirm',
    'uses' => 'School\Newsboard\Http\Controllers\NewsBoardController@confirm',
]);

//});
