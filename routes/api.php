<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('create')->group(function () {
        Route::post('/member', [MemberRepository::class, 'create']);
        Route::post('/game', [GameRepository::class, 'create']);
    });
    Route::prefix('update')->group(function () {
        Route::post('/member/{id}', [MemberRepository::class, 'update']);
        Route::post('/game/{id}', [GameRepository::class, 'update']);
    });
    Route::prefix('delete')->group(function () {
        Route::post('/member/{id}', [MemberRepository::class, 'delete']);
        Route::post('/game/{id}', [GameRepository::class, 'delete']);
    });
});
