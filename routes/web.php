<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SIGMA Project (Jalur Fix)
|--------------------------------------------------------------------------
*/

// 1. Halaman Login Utama
Route::get('/', function () {
    return view('auth.login');
});

// ==========================================
// 2. JALUR AKSES ADMIN (Memakai Layout app.blade.php)
// ==========================================
Route::get('/dashboard', function () {
    return view('admin.dashboard'); 
});

Route::get('/admin/item-management', function () {
    return view('admin.item_management'); // Membuka file admin baru kita!
});

Route::get('/admin/category-management', function () {
    return view('admin.category'); 
});

Route::get('/admin/staff-management', function () {
    return view('admin.staff'); 
});

Route::get('/admin/activity-log', function () {
    return view('admin.activity_log'); 
});

// ==========================================
// 3. JALUR AKSES STAFF
// ==========================================
Route::get('/staff/dashboard', function () {
    return view('staff.dashboard'); 
});

Route::get('/staff/item-management', function () {
    return view('staff.item_management'); 
});

Route::get('/staff/activity-log', function () {
    return view('staff.activity_log'); 
});