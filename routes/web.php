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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('customers', 'CustomersController@datagrid');
Route::post('customers', 'CustomersController@datagrid');
 Route::get('employees', 'EmployeesController@datagrid');
 Route::post('employees', 'EmployeesController@datagrid');
 Route::get('films', 'FilmsController@datagrid');
 Route::post('films', 'FilmsController@datagrid');

