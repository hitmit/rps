<?php
//Route::group(['middleware' => 'auth'], function () {

Route::resource('feetype', 'School\Accounts\Http\Controllers\FeeTypesController');

Route::get('feetype/{id}/confirm', [
    'as' => 'feetype.confirm',
    'uses' => 'School\Accounts\Http\Controllers\FeeTypesController@confirm',
]);

Route::resource('feeAllocation', 'School\Accounts\Http\Controllers\FeeAllocationController');

Route::get('feeAllocation/{id}/confirm', [
    'as' => 'feeAllocation.confirm',
    'uses' => 'School\Accounts\Http\Controllers\FeeAllocationController@confirm',
]);

//});