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
})->middleware('guest');

Route::get('/add-event',  'EventController@addEvent')->middleware('auth')->name('event.add');
Route::get('/event/{id}/detail', 'EventController@eventDetail')->middleware('auth')->name('event.detail');
Route::post('/create-event', 'EventController@createEvent')->middleware('auth')->name('event.create');

Route::get('/dashboard', 'EventController@home')->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
