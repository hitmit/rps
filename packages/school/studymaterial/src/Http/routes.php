<?php


//Route::group(['middleware' => 'admin'], function () {
Route::resource('studymaterials', 'School\StudyMaterial\Http\Controllers\StudyMaterialController');
Route::get('studymaterials/{id}/confirm', array(
    'as' => 'studymaterials.confirm',
    'uses' => 'School\StudyMaterial\Http\Controllers\StudyMaterialController@confirm',
));

//});
