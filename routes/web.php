<?php

use Illuminate\Support\Facades\Route;

// Validations
use App\Http\Middleware\Validations\TicketCreation;
use App\Http\Middleware\Validations\TicketUpdate;
use App\Http\Middleware\Validations\TicketDelete;

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
    Route::get('/create', [App\Http\Controllers\TicketController::class, 'create'])->middleware(TicketCreation::class);
    Route::get('/update', [App\Http\Controllers\TicketController::class, 'update'])->middleware(TicketUpdate::class);
    Route::get('/delete', [App\Http\Controllers\TicketController::class, 'delete'])->middleware(TicketDelete::class);

    // Status
    Route::get('/changeStatus', [App\Http\Controllers\TicketController::class, 'changeStatus']);

    // Set Users
    Route::get('/assignUser', [App\Http\Controllers\TicketController::class, 'assignUser']);
    //Route::get('/dissAssignUser', [App\Http\Controllers\TicketController::class, 'assignUser']);
});

Route::prefix('status')->group(function () {
    //Route::get('/create', [App\Http\Controllers\TicketController::class, 'create']);
    //Route::get('/update', [App\Http\Controllers\TicketController::class, 'changeStatus']);
    //Route::get('/delete', [App\Http\Controllers\TicketController::class, 'delete']);
});


Route::prefix('users')->group(function () {
    //Route::get('/create', [App\Http\Controllers\TicketController::class, 'assignUser']);
    //Route::get('/assignUser', [App\Http\Controllers\TicketController::class, 'assignUser']);
    //Route::get('/assignUser', [App\Http\Controllers\TicketController::class, 'assignUser']);
});

Route::prefix('tests')->group(function () {
    Route::get('/start', [App\Http\Controllers\TestTicketSystem::class, 'createTestValues']);
});
