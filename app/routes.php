<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/
Route::get('', [ 'uses' => 'ExportController@welcome', 'as' => 'home'] );
Route::get('view', [ 'uses' => 'ExportController@viewStudents', 'as' => 'view'] );
Route::get('export', [ 'uses' => 'ExportController@exportStudentsToCSV', 'as' => 'export'] );
Route::get('attendance', [ 'uses' => 'ExportController@exporttCourseAttendenceToCSV', 'as' => 'attendance'] );
Route::post('exportSelected', [ 'uses' => 'ExportController@exportSelected', 'as' => 'exportSelected'] );