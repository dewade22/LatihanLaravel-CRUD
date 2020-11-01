<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::prefix('karyawan')->group(function(){
//     Route::get('/', 'karyawanController@index');
//     Route::post('/simpan', 'karyawanController@save');
//     Route::post('/getKaryawan', 'karyawanController@show');
//     Route::post('/ubah', 'karyawanController@update');
//     Route::post('/hapus', 'karyawanController@destroy');
// });
Route::resource('/karyawans', 'karyawansController');
Route::post('karyawans/ubah/{id}', 'karyawansController@ubah');
Route::get('karyawans/hapus/{id}', 'karyawansController@hapus');