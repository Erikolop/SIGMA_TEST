<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes - SIGMA Project (Jalur Bypass Session Paling Paten)
|--------------------------------------------------------------------------
*/

// 1. Halaman Login Utama
Route::get('/', function () {
    if (session()->has('role')) {
        return session('role') === 'staff' ? redirect('/staff/dashboard') : redirect('/dashboard');
    }
    return view('auth.login'); // Memastikan nge-link ke file resources/views/auth/login.blade.php kalian
})->name('login');

// PROSES LOGIN BYPASS TOTAL (FIXED: Username & Password Wajib Match Ketat!)
Route::post('/login', function (Request $request) {
    $emailInput = trim(strtolower($request->input('email')));
    $passwordInput = $request->input('password');

    // SKENARIO 1: Login murni sebagai Staff
    if ($emailInput === 'staff' && $passwordInput === 'staff') {
        session(['role' => 'staff', 'name' => 'Erghy (Staff)']);
        return redirect('/staff/dashboard');
    }

    // SKENARIO 2: Login murni sebagai Admin
    if ($emailInput === 'admin' && $passwordInput === 'admin') {
        session(['role' => 'admin', 'name' => 'Chico (Admin)']);
        return redirect('/dashboard');
    }

    // Jika salah input, balikkan ke halaman login dengan flash error message
    return back()->with('login_error', 'Username atau Password salah, Chic! ❌');
});

// PROSES LOGOUT UNTUK CLEAR DATA SESSION
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
Route::get('/admin/category-detail', function () { return view('admin.category_detail'); });
Route::get('/admin/staff-management', function () { return view('admin.staff'); });
Route::get('/admin/activity-log', function () { return view('admin.activity_log'); });

// ==========================================
// 3. JALUR AKSES STAFF
// ==========================================
Route::get('/staff/dashboard', function () { return view('staff.dashboard'); });
Route::get('/staff/item-management', function () { return view('staff.item_management'); });