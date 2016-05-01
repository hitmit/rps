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

//});