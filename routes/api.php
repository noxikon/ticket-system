<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Validations
use App\Http\Middleware\Validations\TicketCreation;
use App\Http\Middleware\Validations\TicketUpdate;
use App\Http\Middleware\Validations\TicketDelete;
use App\Http\Middleware\Validations\TicketAssignUser;
use App\Http\Middleware\Validations\TicketChangeStatus;
use App\Http\Middleware\Validations\TicketUnassignUser;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::prefix('ticket')->group(function () {
        Route::get('/create', [App\Http\Controllers\TicketController::class, 'create'])->middleware(TicketCreation::class);
        Route::get('/update', [App\Http\Controllers\TicketController::class, 'update'])->middleware(TicketUpdate::class);
        Route::get('/delete', [App\Http\Controllers\TicketController::class, 'delete'])->middleware(TicketDelete::class);

        // Status
        Route::get('/changeStatus', [App\Http\Controllers\TicketController::class, 'changeStatus'])->middleware(TicketChangeStatus::class);

        // Set Users
        Route::get('/assignUser', [App\Http\Controllers\TicketController::class, 'assignUser'])->middleware(TicketAssignUser::class);
        Route::get('/unassignUser', [App\Http\Controllers\TicketController::class, 'unassignUser'])->middleware(TicketUnassignUser::class);
    });

    Route::prefix('status')->group(function () {
        //Route::get('/create', [App\Http\Controllers\TicketController::class, 'create']);
        //Route::get('/delete', [App\Http\Controllers\TicketController::class, 'delete']);
    });

    Route::prefix('users')->group(function () {
        //Route::get('/create', [App\Http\Controllers\TicketController::class, 'assignUser']);
        //Route::get('/update', [App\Http\Controllers\TicketController::class, 'assignUser']);
        //Route::get('/delete', [App\Http\Controllers\TicketController::class, 'assignUser']);
    });

    Route::prefix('tests')->group(function () {
        Route::get('/start', [App\Http\Controllers\TestTicketSystem::class, 'createTestValues']);
    });
});
