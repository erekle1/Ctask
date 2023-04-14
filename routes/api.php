<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\WalletAddressController;
use App\Http\Controllers\API\WalletController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('wallets', [WalletController::class, 'store']);
    Route::get('wallets', [WalletController::class, 'index']);
    Route::get('wallets/{wallet}', [WalletController::class, 'show']);
    Route::apiResource('wallets.addresses', WalletAddressController::class)->only(['store']);
    Route::get('addresses', [WalletAddressController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logout']);
});
