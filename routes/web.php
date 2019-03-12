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
    return view('contenido/contenido');
});
Route::get('/cupon', 'CuponController@index');
Route::post('/crear', 'CuponController@store');

Route::get('/buscarDNI', 'PersonaController@buscarPersona');
Route::get('/login', function () {
    return view('login');
});
