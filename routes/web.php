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

Route::prefix('ticket')->group(function () {
    Route::get('/create', [App\Http\Controllers\Tickets::class, 'create']);
});

Route::prefix('tests')->group(function () {
    Route::get('/createStatus', [App\Http\Controllers\TestTicketSystem::class, 'createStatus']);
});