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

Route::get('/', 'Group@index');
Route::view('/import', 'import')->name('import');
Route::post('/import', 'ImportCSV')->name('handle_import_form');
Route::get('/group/{id}/people/', 'Group@listPeople');
