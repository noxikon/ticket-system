<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Validations\Ticket\TicketCreation;
use App\Http\Middleware\Validations\Ticket\TicketUpdate;
use App\Http\Middleware\Validations\Ticket\TicketDelete;
use App\Http\Middleware\Validations\Ticket\TicketAssignUser;
use App\Http\Middleware\Validations\Ticket\TicketChangeStatus;
use App\Http\Middleware\Validations\Ticket\TicketUnassignUser;
use App\Http\Middleware\Validations\Ticket\TicketAddRelation;
use App\Http\Middleware\Validations\Ticket\TicketRemoveRelation;
use App\Http\Middleware\Validations\Status\StatusCreation;
use App\Http\Middleware\Validations\Status\StatusDelete;
use App\Http\Middleware\Validations\User\UserCreation;
use App\Http\Middleware\Validations\User\UserUpdate;
use App\Http\Middleware\Validations\User\UserDelete;
use App\Http\Middleware\Validations\Relation\RelationCreation;
use App\Http\Middleware\Validations\Relation\RelationDelete;

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

Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::prefix('ticket')->group(function () {
        Route::get('/create', [App\Http\Controllers\TicketController::class, 'create'])->middleware(TicketCreation::class);
        Route::get('/update', [App\Http\Controllers\TicketController::class, 'update'])->middleware(TicketUpdate::class);
        Route::get('/delete', [App\Http\Controllers\TicketController::class, 'delete'])->middleware(TicketDelete::class);

        // ticket relation
        Route::get('/addRelation', [App\Http\Controllers\TicketController::class, 'addTicketRelation'])->middleware(TicketAddRelation::class);
        Route::get('/removeRelation', [App\Http\Controllers\TicketController::class, 'removeTicketRelation'])->middleware(TicketRemoveRelation::class);

        // Status
        Route::get('/changeStatus', [App\Http\Controllers\TicketController::class, 'changeStatus'])->middleware(TicketChangeStatus::class);

        // Set Users
        Route::get('/assignUser', [App\Http\Controllers\TicketController::class, 'assignUser'])->middleware(TicketAssignUser::class);
        Route::get('/unassignUser', [App\Http\Controllers\TicketController::class, 'unassignUser'])->middleware(TicketUnassignUser::class);
    });

    Route::prefix('status')->group(function () {
        Route::get('/create', [App\Http\Controllers\StatusController::class, 'create'])->middleware(StatusCreation::class);
        Route::get('/delete', [App\Http\Controllers\StatusController::class, 'delete'])->middleware(StatusDelete::class);
        Route::get('/all', [App\Http\Controllers\StatusController::class, 'all']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->middleware(UserCreation::class);
        Route::get('/update', [App\Http\Controllers\UserController::class, 'update'])->middleware(UserUpdate::class);
        Route::get('/delete', [App\Http\Controllers\UserController::class, 'delete'])->middleware(UserDelete::class);
    });

    Route::prefix('relation')->group(function () {
        Route::get('/create', [App\Http\Controllers\RelationController::class, 'create'])->middleware(RelationCreation::class);
        Route::get('/delete', [App\Http\Controllers\RelationController::class, 'delete'])->middleware(RelationDelete::class);
        Route::get('/all', [App\Http\Controllers\RelationController::class, 'all']);
    });


    Route::prefix('test')->group(function () {
        Route::get('/start', [App\Http\Controllers\Base::class, 'createTestValues']);
    });
});
