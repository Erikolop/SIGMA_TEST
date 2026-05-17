<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SIGMA Project (Kembali ke Versi Awal Murni Statis)
|--------------------------------------------------------------------------
*/

// 1. Halaman Login Utama (Langsung nampilin halaman login)
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Proses tombol login klik/enter langsung lempar ke dashboard admin (tanpa cek DB)
Route::post('/login', function () {
    return redirect('/dashboard');
});

// Tombol logout klik langsung balikin ke halaman login awal
Route::post('/logout', function () {
    return redirect('/');
})->name('logout');


// ==========================================
// 2. JALUR AKSES ADMIN (Tinggal Akses Langsung Plong)
// ==========================================
Route::get('/dashboard', function () { 
    return view('admin.dashboard'); 
});

Route::get('/admin/item-management', function () { 
    return view('admin.item_management'); 
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
// 3. JALUR AKSES STAFF (Tinggal Akses Langsung Plong)
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