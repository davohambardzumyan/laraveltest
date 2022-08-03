<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
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


/*
 * AUTH ROUTES
 */
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::group(['prefix' => 'tickets', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', [TicketController::class, 'index']);
    Route::get('/get-all-users', [TicketController::class, 'getAllUsers']);
    Route::post('/create', [TicketController::class, 'create']);
});
