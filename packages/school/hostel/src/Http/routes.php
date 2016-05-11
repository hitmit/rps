<?php

//Route::group(['middleware' => 'auth'], function () {

Route::resource('hostel', 'School\Hostel\Http\Controllers\HostelController');
Route::get('hostel/{id}/confirm', [
    'as' => 'hostel.confirm',
    'uses' => 'School\Hostel\Http\Controllers\HostelController@confirm',
]);

Route::resource('hostelCat', 'School\Hostel\Http\Controllers\HostelCategoryController');
Route::get('hostelCat/{id}/confirm', [
    'as' => 'hostelCat.confirm',
    'uses' => 'School\Hostel\Http\Controllers\HostelCategoryController@confirm',
]);

//});