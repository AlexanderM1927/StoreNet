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

Route::get('/', 'WebsiteController@index')->name('index');
Route::get('/home', 'WebsiteController@home');
Route::get('/comprar', 'WebsiteController@comprar');
Route::get('/empleado', 'WebsiteController@empleado');
Route::get('/cliente', 'WebsiteController@cliente');
Route::get('/producto', 'WebsiteController@producto');
Route::get('/tarjeta', 'WebsiteController@tarjeta');
Route::get('/tarjetas', 'WebsiteController@tarjetas');
Route::get('/compras', 'WebsiteController@compras');
Route::get('/logout', 'LoginController@logout');
Route::get('/procesarProductos/{type}/{params?}/{data?}/{idafiliado?}', 'ActionController@procesaProductos');
Route::get('/procesarClientes/{type}/{params?}/{data?}', 'ActionController@procesaClientes');
Route::get('/procesarEmpleados/{type}/{idafiliado}/{params?}/{data?}', 'ActionController@procesaEmpleados');
Route::get('/procesarTarjetas/{type}/{idcliente?}', 'ActionController@procesaTarjetas');
Route::get('/procesarCompras/{type}/{idcliente?}/{idfactura?}/{idafiliado?}', 'ActionController@procesaCompras');


//FORMULARIOS POST
Route::post('/', 'LoginController@login');
Route::post('/action_comprar', 'ActionController@comprar');
Route::post('/procesarClientes/{type}', 'ActionController@procesaClientes');
Route::post('/procesarEmpleados/{type}', 'ActionController@procesaEmpleados');
Route::post('/procesarProductos/{type}', 'ActionController@procesaProductos');
Route::post('/procesarTarjetas/{type}', 'ActionController@procesaTarjetas');
Route::post('/procesarCompras/{type}', 'ActionController@procesaCompras');