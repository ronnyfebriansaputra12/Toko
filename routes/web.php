<?php

use App\Http\Controllers\BarangController;
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

Route::get('/dashboard', function () {
    return view('admins.dashboard');
});

Route::get('/office', function () {
    return view('admins.barang.create');
});

Route::resource('barang', BarangController::class);
Route::post('/barang-tambah','App\Http\Controllers\BarangController@store');

Route::get('/login','App\Http\Controllers\AuthenticationController@index');
Route::post('/login/proses','App\Http\Controllers\AuthenticationController@login');
Route::get('/register','App\Http\Controllers\AuthenticationController@pageRegister');
Route::post('/register/proses','App\Http\Controllers\AuthenticationController@register');
Route::get('/logout','App\Http\Controllers\AuthenticationController@logout');