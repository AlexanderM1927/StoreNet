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
Route::get('/logout', 'LoginController@logout');
Route::get('/procesarProductos/{type}/{params?}', 'ActionController@procesaProductos');
Route::get('/procesarClientes/{type}/{params?}/{data?}', 'ActionController@procesaClientes');
Route::get('/procesarEmpleados/{type}/{idafiliado}/{params?}/{data?}', 'ActionController@procesaEmpleados');


//FORMULARIOS POST
Route::post('/', 'LoginController@login');
Route::post('/action_comprar', 'ActionController@comprar');
Route::post('/procesarClientes/{type}/{params}', 'ActionController@procesaClientes'); //Agregar cliente
Route::post('/procesaEmpleados/{type}/{params}/{data?}', 'ActionController@procesaEmpleados'); //Agregar empleado