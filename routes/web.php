<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ActivitylogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Models\Item;

/* ─────────────────────────────────────
   Guest routes  (unauthenticated only)
───────────────────────────────────── */
Route::middleware('guest')->group(function () {
    Route::get('/', fn() => redirect()->route('login'));

    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

/* ─────────────────────────────────────
   Authenticated routes
───────────────────────────────────── */
Route::middleware('auth')->group(function () {

    // Dashboard — redirects based on role
    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('viewDashboard');

    // Item Management (shared — staff & admin)
    Route::get('/item-management', [ItemController::class, 'Item'])->name('Item');

    // Kelola Barang (legacy — kept for backward compatibility)
    Route::get('/kelola-barang',  [StaffController::class, 'itemManagement'])->name('itemManagement');
    Route::post('/kelola-barang', [StaffController::class, 'itemProcess'])->name('itemProcess');

    // Activity Log (staff version)
    Route::get('/activity-log', [ActivitylogController::class, 'activityLog'])->name('activityLog');

    // Data Barang (legacy)
    Route::get('/data-barang', [StaffController::class, 'viewItem'])->name('viewItem');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Item routes (shared — edit stock for staff, full CRUD for admin handled by middleware in controller)
    Route::put('/item/edit/{id}',    [ItemController::class, 'editItem'])->name('editItem');
    Route::delete('/item/delete/{id}', [ItemController::class, 'deleteItem'])->name('deleteItem');
    Route::post('/item/bulk-delete', [ItemController::class, 'bulkDeleteItems'])->name('bulkDeleteItems');

    /* ─────────────────────────────────────
       Admin-only routes
    ───────────────────────────────────── */
    Route::prefix('admin')->middleware('admin')->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');

        // Category Management
        Route::get('/category-management', [CategoryController::class, 'categoryManagement'])->name('categoryManagement');
        Route::get('/category/{id}', [CategoryController::class, 'detailCategory'])->name('detailCategory');
        Route::post('/category/add', [CategoryController::class,  'addCategory'])->name('addCategory');
        Route::delete('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
        Route::put('/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('editCategory');
        Route::post('/category/bulk-delete', [CategoryController::class, 'bulkDeleteCategories'])->name('bulkDeleteCategories');

        // Detail Category — edit item from detail page
        Route::put('/category/{categoryId}/item/{id}', [CategoryController::class, 'editItemFromDetail'])->name('editItemFromDetail');

        // Item Management — admin add items
        Route::post('/item/add', [ItemController::class, 'addItems'])->name('addItems');

        // Staff Management
        Route::get('/staff-management', [AdminController::class, 'staffManagement'])->name('staffManagement');
        Route::post('/staff/add',       [AdminController::class, 'addStaff'])->name('addStaff');
        Route::put('/staff/edit/{id}',  [AdminController::class, 'editStaff'])->name('editStaff');
        Route::delete('/staff/delete/{id}', [AdminController::class, 'deleteStaff'])->name('deleteStaff');
        Route::post('/staff/bulk-delete', [AdminController::class, 'bulkDeleteStaff'])->name('bulkDeleteStaff');

        // Activity Log (admin version)
        Route::get('/activity-log', [AdminController::class, 'activityLog'])->name('adminActivityLog');
    });
});