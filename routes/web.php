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

//LogIn
Route::get('/', 'App\Http\Controllers\HomeController@login');
Route::post('/authentication','App\Http\Controllers\HomeController@auth');
Route::get('/logout', 'App\Http\Controllers\HomeController@logout');

// CRUD Buku
Route::get('/daftarBuku', 'App\Http\Controllers\HomeController@index');
Route::get('/inputBuku', 'App\Http\Controllers\HomeController@inputBuku');
Route::post('/inputBuku/add','App\Http\Controllers\HomeController@add');
Route::get('/buku/hapus/{id}','App\Http\Controllers\HomeController@hapusBuku');
Route::get('/buku/edit/{id}','App\Http\Controllers\HomeController@editBuku');
Route::post('/buku/update','App\Http\Controllers\HomeController@update');

// Pinjam Buku
Route::get('/pinjamBuku/{id}', 'App\Http\Controllers\UserController@pinjamBuku');
Route::post('/inputPeminjaman', 'App\Http\Controllers\UserController@inputPeminjaman');
Route::get('/listPinjaman', 'App\Http\Controllers\UserController@listPinjaman');
Route::get('/kembalikanBuku/{id}', 'App\Http\Controllers\UserController@kembalikanBuku');

// Daftar Peminjam Buku
Route::get('/dataPeminjaman', 'App\Http\Controllers\HomeController@dataPeminjaman');
Route::get('/updateStatus/{id}', 'App\Http\Controllers\HomeController@updateStatus');