<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () { 
    return redirect('/login'); 
});

Route::get('/login', function () { 
    return view('auth.login'); 
});

Route::get('/dashboard', function () { 
    return view('admin.dashboard'); 
});

Route::get('/staff-management', function () { 
    return view('admin.staff'); 
});

Route::get('/category-management', function () { 
    return view('admin.category'); 
});

Route::get('/category-detail', function () { 
    return view('admin.category_detail'); 
});

Route::get('/activity-log', function () {
     return view('admin.activity_log'); });

Route::get('/staff/activity-log', function () { 
    return view('admin.activity_log'); });

Route::get('/staff/dashboard', function () { 
    return view('staff.dashboard'); 
});

Route::get('/staff/item-management', function () { 
    return view('staff.item_management'); 
});

// TAMBAHKAN INI: Route Activity Log buat Staff
Route::get('/staff/activity-log', function () { 
    return view('admin.activity_log'); 
});