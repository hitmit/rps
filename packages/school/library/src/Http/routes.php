<?php

//Route::group(['middleware' => 'admin'], function () {
Route::resource('library', 'School\Library\Http\Controllers\LibraryController');
Route::get('library/{id}/confirm', [
    'as' => 'library.confirm',
    'uses' => 'School\Library\Http\Controllers\libraryController@confirm',
]);

//});
