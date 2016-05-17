<?php


//Route::group(['middleware' => 'admin'], function () {
    Route::resource('parents', 'School\Parents\Http\Controllers\ParentsController');
    Route::get('parents/{id}/confirm', array(
      'as' => 'parents.confirm',
      'uses' => 'School\Parents\Http\Controllers\ParentsController@confirm',
    ));

//});
