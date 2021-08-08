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

// Admin Route
Route::get('/admin/login', function () {
    return view('admin.login');
});
Route::post('/admin/login', 'AdminController@login_action');
Route::get('/admin/logout', 'AdminController@logout_action')->middleware('admin');
Route::get('/admin/dashboard', 'AdminController@dashboard')->middleware('admin');

Route::get('/admin/bidang-pekerjaan', 'AdminController@bidang_pekerjaan')->middleware('admin');
Route::post('/admin/bidang_pekerjaan_store', 'AdminController@bidang_pekerjaan_store')->middleware('admin');
Route::get('/admin/bidang-pekerjaan/edit/{id}', 'AdminController@bidang_pekekerjaan_edit')->middleware('admin');
Route::post('/admin/bidang-pekerjaan/update', 'AdminController@bidang_pekerjaan_update')->middleware('admin');
Route::get('/admin/bidang-pekerjaan/delete/{id}', 'AdminController@bidang_pekerjaan_delete')->middleware('admin');

Route::get('/admin/perusahaan', 'AdminController@perusahaan')->middleware('admin');
Route::post('/admin/perusahaan_store', 'AdminController@perusahaan_store')->middleware('admin');
Route::get('/admin/perusahaan/detail/{id}', 'AdminController@perusahaan_detail')->middleware('admin');
Route::get('/admin/perusahaan/edit/{id}', 'AdminController@perusahaan_edit')->middleware('admin');
Route::post('/admin/perusahaan/update', 'AdminController@perusahaan_update')->middleware('admin');
Route::get('/admin/perusahaan/delete/{id}', 'AdminController@perusahaan_delete')->middleware('admin');

Route::get('/admin/pekerjaan', 'AdminController@pekerjaan')->middleware('admin');
Route::post('/admin/pekerjaan_store', 'AdminController@pekerjaan_store')->middleware('admin');
Route::get('/admin/pekerjaan/detail/{id}', 'AdminController@pekerjaan_detail')->middleware('admin');
Route::get('/admin/pekerjaan/edit/{id}', 'AdminController@pekerjaan_edit')->middleware('admin');
Route::post('/admin/pekerjaan/update', 'AdminController@pekerjaan_update')->middleware('admin');
Route::get('/admin/pekerjaan/delete/{id}', 'AdminController@pekerjaan_delete')->middleware('admin');

Route::get('/admin/pelamar', 'AdminController@pelamar')->middleware('admin');
Route::get('/admin/pelamar/detail/{id}', 'AdminController@pelamar_detail')->middleware('admin');
Route::get('/admin/pelamar/delete/{id}', 'AdminController@pelamar_delete')->middleware('admin');

// Perusahaan Route
Route::get('/perusahaan/login', function () {
    return view('perusahaan.login');
});
Route::post('/perusahaan/login', 'PerusahaanController@login_action');
Route::get('/perusahaan/logout', 'PerusahaanController@logout_action')->middleware('perusahaan');
Route::get('/perusahaan/dashboard', 'PerusahaanController@dashboard')->middleware('perusahaan');

Route::get('/perusahaan/data-perusahaan', 'PerusahaanController@data_perusahaan')->middleware('perusahaan');

Route::get('/perusahaan/pekerjaan', 'PerusahaanController@pekerjaan')->middleware('perusahaan');
Route::post('perusahaan/pekerjaan_store', 'PerusahaanController@pekerjaan_store')->middleware('perusahaan');
Route::get('/perusahaan/pekerjaan/detail/{id}', 'PerusahaanController@pekerjaan_detail')->middleware('perusahaan');
Route::get('/perusahaan/pekerjaan/edit/{id}', 'PerusahaanController@pekerjaan_edit')->middleware('perusahaan');
Route::post('/perusahaan/pekerjaan/update', 'PerusahaanController@pekerjaan_update')->middleware('perusahaan');
Route::get('/perusahaan/pekerjaan/delete/{id}', 'PerusahaanController@pekerjaan_delete')->middleware('perusahaan');

Route::get('/perusahaan/pelamar', 'PerusahaanController@pelamar')->middleware('perusahaan');
Route::get('/perusahaan/pelamar/detail/{id}', 'PerusahaanController@pelamar_detail')->middleware('perusahaan');
Route::get('/perusahaan/pelamar/delete/{id}', 'PerusahaanController@pelamar_delete')->middleware('perusahaan');

// Frontend Route
// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', 'FrontendController@index');
Route::get('/bidang-pekerjaan/{id}', 'FrontendController@bidang_pekerjaan');
Route::get('/data-pekerjaan-detail/{id}', 'FrontendController@detail_pekerjaan');
Route::post('/kirim-lamaran', 'FrontendController@kirim_lamaran_action');
