<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;

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

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('tokens/create', 'login');
        //        Route::post('tokens/revoke' 'logout');
        //        Route::get('tokens', 'index');
    });
});

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(TransactionController::class)->prefix('transactions')->group(function () {

        Route::put('/{id}', 'update');

    });

});
