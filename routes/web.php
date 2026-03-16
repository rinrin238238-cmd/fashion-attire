<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});
Route::get('/admin/export', [ContactController::class, 'export']);
Route::post('/admin/delete', [ContactController::class, 'destroy']);
