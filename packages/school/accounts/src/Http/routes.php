<?php
//Route::group(['middleware' => 'auth'], function () {

Route::resource('feetype', 'School\Accounts\Http\Controllers\FeeTypesController');

Route::get('feetype/{id}/confirm', [
    'as' => 'feetype.confirm',
    'uses' => 'School\Accounts\Http\Controllers\FeeTypesController@confirm',
]);

//});