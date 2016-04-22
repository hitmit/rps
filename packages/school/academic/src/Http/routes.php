<?php
//Route::group(['middleware' => 'auth'], function () {

  Route::resource('admin/academic', 'School\Academic\Http\Controllers\academicYearController');

  Route::get('admin/academic/{academic}/confirm', array(
      'as' => 'admin.academic.confirm',
      'uses' => 'School\Academic\Http\Controllers\academicYearController@confirm',
    )
  );

  // Route::get('academic/listAll', array(
  //    'as' => 'academic.listAll',
  //    'uses' => 'School\Academic\Http\Controllers\academicYearController@listAll',
  //   )
  // );

  // Route::get('dashboard','School\Academic\Http\Controllers\academicYearController@dashboard');

  // Route::post('academic/active/{id}','School\Academic\Http\Controllers\academicYearController@active');
  // Route::post('academic','School\Academic\Http\Controllers\academicYearController@create');
  // Route::get('academic/{id}','School\Academic\Http\Controllers\academicYearController@fetch');
  // Route::post('academic/delete/{id}','School\Academic\Http\Controllers\academicYearController@delete');
  // Route::post('academic/{id}','School\Academic\Http\Controllers\academicYearController@edit');

//});
