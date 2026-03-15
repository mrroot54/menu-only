<?php

use Illuminate\Support\Facades\Route;
// Yahan Admin folder ka Controller import kar rahe hain
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================================
// 1. CUSTOMER FRONTEND (Public)
// ============================================================

// Ye route 'index.blade.php' file ko load karega (Customer Menu Page)
Route::get('/', function () {
    return view('index');
})->name('customer.menu');


// ============================================================
// 2. ADMIN AUTHENTICATION (Login/Logout)
// ============================================================

// Admin Login Page Show
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');

// Admin Login Form Submit
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');


// ============================================================
// 3. ADMIN PROTECTED ROUTES (Middleware Auth)
// ============================================================

Route::middleware(['auth'])->group(function () {
    
    // Admin Logout
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Admin Dashboard Home
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Admin Categories List Page
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories.index');

    // Admin Menu Items List Page
    Route::get('/admin/menu-items', [AdminController::class, 'menuItems'])->name('admin.menu-items.index');
});