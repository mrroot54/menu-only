<?php

use Illuminate\Support\Facades\Route;
// Controllers Import
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuItemController; // New Import

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

    // -----------------------------------------------------
    // CATEGORIES MANAGEMENT (Resource Controller)
    // -----------------------------------------------------
    Route::resource('admin/categories', CategoryController::class)->names([
        'index'   => 'admin.categories.index',
        'create'  => 'admin.categories.create',
        'store'   => 'admin.categories.store',
        'edit'    => 'admin.categories.edit',
        'update'  => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy'
    ]);

    // -----------------------------------------------------
    // MENU ITEMS MANAGEMENT (Resource Controller)
    // -----------------------------------------------------
    Route::resource('admin/menu-items', MenuItemController::class)->names([
        'index'   => 'admin.menu-items.index',
        'create'  => 'admin.menu-items.create',
        'store'   => 'admin.menu-items.store',
        'edit'    => 'admin.menu-items.edit',
        'update'  => 'admin.menu-items.update',
        'destroy' => 'admin.menu-items.destroy'
    ]);
});