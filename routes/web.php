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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//view of a create new ticket
Route::get('/ticket', 'CustomerController@ticket')->name('ticket');
//create ticket
Route::post('/ticket-create', 'CustomerController@create')->name('ticket.create');
//view ticket list
Route::get('/ticket-list', 'CustomerController@tickets')->name('ticket.list');
//customer search ticket by reference
Route::post('/search-ticket', 'CustomerController@search')->name('ticket.search');
//agent update ticket
Route::post('/ticket-update', 'AgentController@update')->name('ticket.update');
//vie of customer ticket list
Route::get('/home', 'AgentController@index')->name('home');
//view of a customer ticket
Route::get('/view-ticket/{ticket}', 'AgentController@view')->name('ticket.view');
