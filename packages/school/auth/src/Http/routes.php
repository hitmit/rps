<?php

Route::group(['middleware' => 'admin'], function () {
    Route::resource('admin/auth', 'School\Auth\Http\Controllers\LoginController');

    Route::resource('admin/role', 'School\Auth\Http\Controllers\RoleController');

    Route::get('admin/role/{id}/confirm', array(
        'as' => 'admin.role.confirm',
        'uses' => 'School\Auth\Http\Controllers\RoleController@confirm',
    ));
});
Route::group(['middleware' => 'loggedIn'], function () {
    Route::get('home', array(
        'as' => 'home',
        'uses' => 'School\Auth\Http\Controllers\LoginController@home',
    ));
    
    Route::get('logout',[
        'as' => 'logout',
        'uses' => 'School\Auth\Http\Controllers\LoginController@logout',
    ]);
});


Route::get('login', array(
    'as' => 'login.get',
    'uses' => 'School\Auth\Http\Controllers\LoginController@getLogin',
));


Route::post('login', array(
    'as' => 'login.post',
    'uses' => 'School\Auth\Http\Controllers\LoginController@postLogin',
));


Route::get('register', array(
    'as' => 'login',
    'uses' => 'School\Auth\Http\Controllers\RegisterController@index',
));

Route::post('register', array(
    'as' => 'login',
    'uses' => 'School\Auth\Http\Controllers\RegisterController@store',
));


Route::post('register', array(
    'as' => 'login',
    'uses' => 'School\Auth\Http\Controllers\RegisterController@store',
));

Route::get('register/classes', array(
    'as' => 'register.classes',
    'uses' => 'School\Auth\Http\Controllers\RegisterController@registerClasses'
));

Route::get('register/searchStudents/{student}', array(
    'as' => 'register.searchStudents',
    'uses' => 'School\Auth\Http\Controllers\RegisterController@searchStudents'
));

