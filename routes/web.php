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
// Cupones
Route::get('/cupon', 'CuponController@index');
Route::get('/cupon/crear', 'CuponController@store');
Route::get('/cupon/{dni}', 'CuponController@buscarCuponSerial');
Route::get('/cupon/desactivar', 'CuponController@desactivar');
// login

// Marca
Route::get('/marca', 'MarcaController@index');
// Persona
Route::post('/buscarDNI', 'PersonaController@buscarPersona');
Route::get('/persona','PersonaController@index');
Route::post('/persona/registrar', 'PersonaController@store');
Route::get('/persona/{dni}', 'PersonaController@buscarPersonaPorDNI');

// Rol
// User
Route::get('/user','UserController@index');
Route::get('/user/vendedor', 'UserController@showVendedor');
// Venta
Route::post('/venta/registrar','VentaController@store');
Route::get('/venta/detalle','VentaController@listarDetalles');
// VentaCupon
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', function () {
    return view('login');
});