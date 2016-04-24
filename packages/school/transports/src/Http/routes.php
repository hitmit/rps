<?php

//Route::group(['middleware' => 'admin'], function () {
    Route::resource('transports', 'School\Transports\Http\Controllers\TransportsController');
    Route::get('transports/{id}/confirm', array(
      'as' => 'transports.confirm',
      'uses' => 'School\Transports\Http\Controllers\TransportsController@confirm',
    ));
    
    Route::get('transports/list/{id}', array(
      'as' => 'transports.list.fetchSubs',
      'uses' => 'School\Transports\Http\Controllers\TransportsController@fetchSubs',
    ));
//});

