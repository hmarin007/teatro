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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'ReservaController@index')->name('home');

Route::resource('reservacion','ReservaController');

Route::resource('usuarios','UsuarioController');
Route::get('usuarios.data', 'UsuarioController@getData')->name('admin.usuarios.usuarios.data');

