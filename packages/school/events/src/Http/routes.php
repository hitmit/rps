<?php

//Route::group(['middleware' => 'auth'], function () {

Route::resource('events', 'School\Events\Http\Controllers\EventsController');
Route::get('events/{id}/confirm', [
    'as' => 'events.confirm',
    'uses' => 'School\Events\Http\Controllers\EventsController@confirm',
]);

//});
