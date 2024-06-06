<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\RuleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/device', [DeviceController::class, 'index']);
Route::post('/device', [DeviceController::class, 'store']);
Route::get('/device/{id}', [DeviceController::class, 'show']);
Route::put('/device/{id}', [DeviceController::class, 'update']);
Route::delete('/device/{id}', [DeviceController::class, 'destroy']);

Route::get('/log', [LogController::class, 'index']);
Route::post('/log', [LogController::class, 'store']);
Route::get('/log/{id}', [LogController::class, 'show']);
Route::put('/log/{id}', [LogController::class, 'update']);
Route::delete('/log/{id}', [LogController::class, 'destroy']);

Route::get('/rule', [RuleController::class, 'index']);
Route::post('/rule', [RuleController::class, 'store']);
Route::get('/rule/{id}', [RuleController::class, 'show']);
Route::put('/rule/{id}', [RuleController::class, 'update']);
Route::delete('/rule/{id}', [RuleController::class, 'destroy']);