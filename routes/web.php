<?php

use Illuminate\Support\Facades\Route;
// Controllers Import
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================================
// 1. CUSTOMER FRONTEND (Public)
// ============================================================

Route::get('/', function () {
    return view('index');
})->name('customer.menu');


// ============================================================
// 2. ADMIN AUTHENTICATION (Login/Logout)
// ============================================================

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');


// ============================================================
// 3. ADMIN PROTECTED ROUTES
// ============================================================

// Note: 'auth' middleware temporarily commented out for development
// Route::middleware(['auth'])->group(function () {

    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Categories Management
    Route::resource('admin/categories', CategoryController::class)->names([
        'index'   => 'admin.categories.index',
        'create'  => 'admin.categories.create',
        'store'   => 'admin.categories.store',
        'edit'    => 'admin.categories.edit',
        'update'  => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy'
    ]);

    // Menu Items Management
    Route::resource('admin/menu-items', MenuItemController::class)->names([
        'index'   => 'admin.menu-items.index',
        'create'  => 'admin.menu-items.create',
        'store'   => 'admin.menu-items.store',
        'edit'    => 'admin.menu-items.edit',
        'update'  => 'admin.menu-items.update',
        'destroy' => 'admin.menu-items.destroy'
    ]);

// }); 