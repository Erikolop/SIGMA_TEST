<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes - SIGMA Project (Jalur Bypass Session Badak)
|--------------------------------------------------------------------------
*/

// 1. Halaman Login Utama
Route::get('/', function () {
    if (session()->has('role')) {
        return session('role') === 'staff' ? redirect('/staff/dashboard') : redirect('/dashboard');
    }
    return view('auth.login');
})->name('login');

// PROSES LOGIN BYPASS TOTAL
Route::post('/login', function (Request $request) {
    $emailInput = trim($request->input('email'));
    $passwordInput = $request->input('password');

    // SKENARIO 1: Username 'staff' & password kosong -> MASUK STAFF
    if ($emailInput === 'staff' && empty($passwordInput)) {
        session(['role' => 'staff', 'name' => 'Erghy (Staff)']);
        return redirect('/staff/dashboard');
    }

    // SKENARIO 2: Selain itu -> OTOMATIS ADMIN
    session(['role' => 'admin', 'name' => 'Chico (Admin)']);
    return redirect('/dashboard');
});

// PROSES LOGOUT
Route::post('/logout', function (Request $request) {
    session()->forget(['role', 'name']);
    return redirect('/');
})->name('logout');


// ==========================================
// 2. JALUR AKSES ADMIN
// ==========================================
Route::get('/dashboard', function () { return view('admin.dashboard'); });
Route::get('/admin/item-management', function () { return view('admin.item_management'); });
Route::get('/admin/category-management', function () { return view('admin.category'); });
Route::get('/admin/staff-management', function () { return view('admin.staff'); });
Route::get('/admin/activity-log', function () { return view('admin.activity_log'); });

// ==========================================
// 3. JALUR AKSES STAFF
// ==========================================
Route::get('/staff/dashboard', function () { return view('staff.dashboard'); });
Route::get('/staff/item-management', function () { return view('staff.item_management'); });