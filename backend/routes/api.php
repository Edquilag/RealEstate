<?php

use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\InquiryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return ['status' => 'ok'];
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::prefix('v1')->group(function () {
    Route::middleware('throttle:60,1')->group(function () {
        Route::get('/properties', [PropertyController::class, 'index']);
        Route::get('/properties/{property}', [PropertyController::class, 'show']);
    });

    Route::middleware(['auth:sanctum', 'role:client', 'throttle:20,1'])->group(function () {
        Route::post('/properties/{property}/inquiries', [InquiryController::class, 'store']);
        Route::get('/inquiries', [InquiryController::class, 'index']);
    });

    Route::middleware(['auth:sanctum', 'role:broker', 'throttle:30,1'])->group(function () {
        Route::get('/broker/inquiries', [InquiryController::class, 'brokerIndex']);
        Route::patch('/broker/inquiries/{inquiry}', [InquiryController::class, 'updateStatus']);
    });
});
