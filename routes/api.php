<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\VideoController;
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


Route::prefix('v1')->group(function () {
    Route::get('videos/{video:slug}', [VideoController::class,'show']);
    Route::get('videos', [VideoController::class,'index']);
    Route::post('videos', [VideoController::class,'store'])->middleware('auth:sanctum');;
    Route::put('videos/{video:slug}', [VideoController::class,'update'])->middleware('auth:sanctum');;
    Route::delete('videos/{video:slug}', [VideoController::class,'destroy'])->middleware('auth:sanctum');;
    Route::get('auth/me', [AuthController::class,'me'])->middleware('auth:sanctum');
    Route::get('auth/logout', [AuthController::class,'logout'])->middleware('auth:sanctum');
});

Route::post('v1/auth/login', [AuthController::class, 'login']);

