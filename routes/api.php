<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/client/list', 'ClientController@getList');

Route::get('/manager/list', 'ManagerController@getList');
Route::get('/manager/statistic', 'ManagerController@getStatistic');

Route::get('/invoice/list', 'InvoiceController@getList');
Route::get('/invoice/create', 'InvoiceController@create');
Route::get('/invoice/payment', 'InvoiceController@payment');
Route::get('/invoice/income-statistic', 'InvoiceController@incomeStatistic');

