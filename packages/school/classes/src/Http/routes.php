<?php
//Route::group(['middleware' => 'auth'], function () {

Route::resource('classes', 'School\Classes\Http\Controller\ClassesController');

Route::get('classes/{id}/confirm', [
    'as' => 'classes.confirm',
    'uses' => 'School\Classes\Http\Controller\ClassesController@confirm',
]);

Route::resource('sections', 'School\Classes\Http\Controller\SectionController');

Route::get('sections/{id}/confirm', [
    'as' => 'sections.confirm',
    'uses' => 'School\Classes\Http\Controller\SectionController@confirm',
]);

Route::get('classschedule', [
    'as' => 'classschedule.index',
    'uses' => 'School\Classes\Http\Controller\ClassScheduleController@index',
]);

Route::get('classschedule/{id}', [
    'as' => 'class.schedule.create',
    'uses' => 'School\Classes\Http\Controller\ClassScheduleController@create',
]);

Route::get('classschedule/{id}/add', [
    'as' => 'class.schedule.add',
    'uses' => 'School\Classes\Http\Controller\ClassScheduleController@createSchedule',
]);

Route::post('classschedule/{id}/add', [
    'as' => 'class.schedule.store',
    'uses' => 'School\Classes\Http\Controller\ClassScheduleController@storeSchedule',
]);

Route::get('classschedule/{id}/edit', [
    'as' => 'class.schedule.edit',
    'uses' => 'School\Classes\Http\Controller\ClassScheduleController@editSchedule',
]);

Route::put('classschedule/{id}/edit', [
    'as' => 'class.schedule.update',
    'uses' => 'School\Classes\Http\Controller\ClassScheduleController@updateSchedule',
]);

Route::get('classschedule/{id}/confirm', [
    'as' => 'class.schedule.confirm',
    'uses' => 'School\Classes\Http\Controller\ClassScheduleController@confirm',
]);

Route::delete('classschedule/{id}/delete', [
    'as' => 'class.schedule.destroy',
    'uses' => 'School\Classes\Http\Controller\ClassScheduleController@destroy',
]);

//});
