<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/
Route::get('', [ 'uses' => 'ExportController@welcome', 'as' => 'home'] );
Route::get('view', [ 'uses' => 'ExportController@viewStudents', 'as' => 'view'] );
Route::get('export', [ 'uses' => 'ExportController@exportStudentsToCSV', 'as' => 'export'] );