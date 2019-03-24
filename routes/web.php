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
Route::group(['middleware' => ['guest']], function () {
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login','Auth\LoginController@login')->name('login');
});
Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout','Auth\LoginController@logout')->name('logout');
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');
    Route::group(['middleware' => ['Administrador']], function () {
        // Cupones
        Route::get('/cupon', 'CuponController@index');
        Route::get('/cupon/crear', 'CuponController@store');
        Route::get('/cupon/{dni}', 'CuponController@buscarCuponSerial');
        Route::get('/cupon/desactivar', 'CuponController@desactivar');
        // login

        // Marca
        Route::get('/marca', 'MarcaController@index');
        Route::put('/marca/actualizar', 'MarcaController@update');
        // Persona
        Route::post('/buscarDNI', 'PersonaController@buscarPersona');
        Route::get('/persona','PersonaController@index');
        Route::post('/persona/registrar', 'PersonaController@store');
        Route::get('/persona/{dni}', 'PersonaController@buscarPersonaPorDNI');

        // Rol
        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol','RolController@selectRol');
        // User
        Route::get('/user','UserController@index');
        Route::get('/user/vendedor', 'UserController@showVendedor');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');
        // Venta
        Route::post('/venta/registrar','VentaController@store');
        Route::get('/venta/detalle','VentaController@listarDetalles');
        // VentaCupon

        
    });
    

});

