<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ============================================================
// 1. PUBLIC ROUTES (Customer Side - No Token Required)
// ============================================================

// Auth
Route::post('/login', [AuthController::class, 'login']);

// Customer Menu Access
Route::get('/categories', [CategoryController::class, 'index']); // Categories List
Route::get('/menu-items', [MenuItemController::class, 'index']); // All Menu Items
Route::get('/top-selling', [MenuItemController::class, 'topSelling']); // Top Selling Items
Route::get('/search', [MenuItemController::class, 'search']); // Search Items


// ============================================================
// 2. PROTECTED ROUTES (Admin Side - Token Required)
// ============================================================
Route::middleware(['auth:sanctum'])->group(function () {
    
    // Auth
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // -----------------------------------------------------
    // CATEGORY MANAGEMENT (Admin Only)x
    // -----------------------------------------------------
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // -----------------------------------------------------
    // MENU ITEM MANAGEMENT (Admin Only)
    // -----------------------------------------------------
    Route::post('/menu-items', [MenuItemController::class, 'store']);
    Route::post('/menu-items/{id}', [MenuItemController::class, 'update']); // POST for file upload
    Route::delete('/menu-items/{id}', [MenuItemController::class, 'destroy']);
});


