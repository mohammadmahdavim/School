<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin/backup')->group(function() {
    Route::get('/', 'BackupController@index');
    Route::get('/create', 'BackupController@create');
    Route::get('/download/{file_name}', 'BackupController@download');
    Route::get('/delete/{file_name}', 'BackupController@delete');
});
