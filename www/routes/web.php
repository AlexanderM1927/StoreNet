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
Route::get('/homeadm', 'WebsiteController@homeadm')->name('afiliado');
Route::get('/comprar', 'WebsiteController@comprar');
Route::get('/empleado', 'WebsiteController@empleado');
Route::get('/cliente', 'WebsiteController@cliente');
Route::get('/producto', 'WebsiteController@producto');
Route::get('/tarjeta', 'WebsiteController@tarjeta');
Route::get('/tarjetas', 'WebsiteController@tarjetas');
Route::get('/compras', 'WebsiteController@compras');
Route::get('/pedidos', 'WebsiteController@pedidos');
Route::get('/gpedidos', 'WebsiteController@gpedidos');
Route::get('/devoluciones', 'WebsiteController@devoluciones');
Route::get('/inventario', 'WebsiteController@inventario');
Route::get('/estadisticas', 'WebsiteController@estadisticas');
Route::get('/afiliados', 'WebsiteController@afiliados');
Route::get('/ajustes', 'WebsiteController@ajustes');
Route::get('/nomina', 'WebsiteController@nomina');
Route::get('/nominas', 'WebsiteController@nominas');
Route::get('/visorfacturas', 'WebsiteController@visorfacturas');
Route::get('/balance/{idafiliado}/{desde}/{hasta}', 'WebsiteController@balance');
Route::get('/reportes', 'WebsiteController@reportes');
Route::get('/logout', 'LoginController@logout');
Route::get('/procesarProductos/{type}/{params?}/{data?}/{idafiliado?}', 'ActionController@procesaProductos');
Route::get('/procesarClientes/{type}/{params?}/{data?}', 'ActionController@procesaClientes');
Route::get('/procesarEmpleados/{type}/{idafiliado}/{params?}/{data?}', 'ActionController@procesaEmpleados');
Route::get('/procesarTarjetas/{type}/{idcliente?}', 'ActionController@procesaTarjetas');
Route::get('/procesarCompras/{type}/{idcliente?}/{idfactura?}/{idafiliado?}', 'ActionController@procesaCompras');
Route::get('/procesarPedidos/{type}/{idcliente?}/{fecha?}/{estado?}/{idafiliado?}', 'ActionController@procesaPedidos');
Route::get('/procesarEstadisticas/{type}/{idafiliado?}/{fechas?}', 'ActionController@procesaEstadisticas');
Route::get('/procesarAfiliados/{type}/{afiliado?}', 'ActionController@procesaAfiliados');
Route::get('/procesarAjustes/{type}/{idafiliado}/{rango}/{idusuario}', 'ActionController@procesaAjustes');
Route::get('/procesarVisor/{type}/{idafiliado}/{fecha?}', 'ActionController@procesaVisor');
Route::get('/procesarNomina/{type}/{idafiliado}/{idusuario?}/{fechas?}', 'ActionController@procesaNomina');
Route::get('/procesarReportes/{type}/{fechas?}', 'ActionController@procesaReportes');


//FORMULARIOS POST
Route::post('/', 'LoginController@login');
secure_url(Route::post('/action_comprar', 'ActionController@comprar'));
secure_url(Route::post('/procesarClientes/{type}', 'ActionController@procesaClientes'));
secure_url(Route::post('/procesarEmpleados/{type}', 'ActionController@procesaEmpleados'));
secure_url(Route::post('/procesarProductos/{type}', 'ActionController@procesaProductos'));
secure_url(Route::post('/procesarTarjetas/{type}', 'ActionController@procesaTarjetas'));
secure_url(Route::post('/procesarCompras/{type}', 'ActionController@procesaCompras'));
secure_url(Route::post('/procesarPedidos/{type}', 'ActionController@procesaPedidos'));
secure_url(Route::post('/procesarDevoluciones', 'ActionController@procesaDevoluciones'));
secure_url(Route::post('/procesarAfiliados/{type}', 'ActionController@procesaAfiliados'));
secure_url(Route::post('/procesarAjustes/{type}', 'ActionController@procesaAjustes'));
secure_url(Route::post('/procesarNomina/{type}', 'ActionController@procesaNomina'));
secure_url(Route::post('/procesarReportes/{type}', 'ActionController@procesaReportes'));
secure_url(Route::post('/administrador', 'ActionController@administrador'));