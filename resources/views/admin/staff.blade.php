@extends('layouts.app')

@section('title', 'Staff Management - SIGMA')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    /* Reset padding content body agar layouting pas dengan Figma */
    .content-body {
        padding: 30px 40px !important;
        background-color: #f4f5f9;
    }

    /* 1. Judul Gede Tengah */
    .page-title-center {
        text-align: center;
        font-size: 28px;
        font-weight: 800;
        color: #1e1b4b;
        margin-top: 10px;
        margin-bottom: 40px;
        letter-spacing: 0.5px;
    }

    /* 2. Top Action Bar */
    .action-bar-staff {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .search-box-staff {
        position: relative;
        max-width: 280px;
        width: 100%;
    }
    .search-box-staff i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    .search-box-staff .form-control {
        padding: 10px 15px 10px 42px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 13px;
        background-color: #ffffff;
    }
    .btn-add-user {
        background-color: #1e1b4b;
        color: #ffffff;
        font-size: 12px;
        font-weight: 700;
        padding: 11px 22px;
        border-radius: 8px;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* 3. Main Table Wrapper */
    .table-wrapper-staff {
        background-color: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .staff-table-admin {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .staff-table-admin thead th {
        background-color: #3f3d8f;
        color: #ffffff;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.8px;
        padding: 18px 15px;
        border: none;
    }
    .staff-table-admin td {
        padding: 16px 15px;
        border-bottom: 1px solid #f3f4f6;
        color: #4b5563;
        vertical-align: middle;
    }

    /* Checkbox */
    .td-checkbox { width: 60px; }
    .form-check-input-custom {
        width: 16px; height: 16px; cursor: pointer; border: 1px solid #d1d5db; border-radius: 4px;
    }

    /* Teks Normal */
    .text-name-bold { font-weight: 700; color: #111827; }
    .text-normal-field { font-weight: 500; color: #4b5563; }

    /* Input Form khusus pas di-klik Edit */
    .form-editable-sm {
        font-size: 13px;
        padding: 5px 10px;
        border-radius: 6px;
        border: 1px solid #2563eb;
        width: 90%;
        font-weight: 500;
    }
    .select-editable-sm {
        font-size: 13px;
        padding: 5px 8px;
        border-radius: 6px;
        border: 1px solid #2563eb;
        background-color: white;
        font-weight: 600;
        color: #111827;
    }

    /* Actions Style (Normal vs Edit) */
    .action-icons-box {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        font-size: 16px;
        min-height: 32px;
    }
    .icon-edit-grey { color: #9ca3af !important; cursor: pointer; }
    .icon-edit-grey:hover { color: #4b5563 !important; }
    .icon-delete-red { color: #dc2626 !important; cursor: pointer; }
    .icon-delete-red:hover { color: #991b1b !important; }

    /* Tombol Centang Hijau Simpan */
    .btn-submit-save-user {
        background-color: #22c55e;
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(34, 197, 94, 0.3);
    }

    /* 4. Footer Pagination Bar */
    .footer-pagination-staff {
        background-color: #2e2a85;
        color: #ffffff;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
    }
    .pg-staff-container {
        display: flex; gap: 6px; align-items: center;
    }
    .pg-staff-container a {
        color: rgba(255, 255, 255, 0.6); text-decoration: none; padding: 4px 10px; font-weight: 600;
    }
    .active-pg-box { background-color: #2563eb; color: #ffffff !important; border-radius: 4px; }
    
    [x-cloak] { display: none !important; }
</style>

<h2 class="page-title-center">Staff Management</h2>

<div class="action-bar-staff">
    <div class="search-box-staff">
        <i class="fa-solid fa-search"></i>
        <input type="text" class="form-control" placeholder="Search">
    </div>
    <button class="btn-add-user shadow-sm">
        <i class="fa-solid fa-user-plus"></i> Add User
    </button>
</div>

<div class="table-wrapper-staff" x-data="{ editUserId: null }">
    <table class="staff-table-admin text-center align-middle">
        <thead>
            <tr>
                <th class="td-checkbox"><input type="checkbox" class="form-check-input form-check-input-custom"></th>
                <th style="width: 20%;" class="text-start">Full Name</th>
                <th style="width: 25%;" class="text-start">Email</th>
                <th style="width: 15%;" class="text-start">Username</th>
                <th style="width: 15%;" class="text-start">Role</th>
                <th style="width: 20%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $users = [
                    ['id' => 'u1', 'name' => 'Daffa', 'email' => 'Daffa6666@gmail.com', 'username' => 'dapa', 'role' => 'Admin'],
                    ['id' => 'u2', 'name' => 'Daffa', 'email' => 'Daffa6666@gmail.com', 'username' => 'dapa', 'role' => 'Admin'],
                    ['id' => 'u3', 'name' => 'Erghy', 'email' => 'Erghy456@gmail.com', 'username' => 'Egi', 'role' => 'Staff'],
                    ['id' => 'u4', 'name' => 'Erghy', 'email' => 'Erghy456@gmail.com', 'username' => 'Egi', 'role' => 'Staff'],
                    ['id' => 'u5', 'name' => 'Ciko', 'email' => 'ChicoDawg@gmail.com', 'username' => 'Ciks', 'role' => 'Admin'],
                    ['id' => 'u6', 'name' => 'Ciko', 'email' => 'ChicoDawg@gmail.com', 'username' => 'Ciks', 'role' => 'Admin'],
                    ['id' => 'u7', 'name' => 'Fitrandi', 'email' => 'sfitrandi1@gmail.com', 'username' => 'Rand', 'role' => 'Staff'],
                    ['id' => 'u8', 'name' => 'Fitrandi', 'email' => 'sfitrandi1@gmail.com', 'username' => 'Rand', 'role' => 'Staff'],
                    ['id' => 'u9', 'name' => 'Putra', 'email' => 'Thufail23@gmail.com', 'username' => 'Putr', 'role' => 'Staff'],
                    ['id' => 'u10', 'name' => 'Putra', 'email' => 'Thufail23@gmail.com', 'username' => 'Putr', 'role' => 'Staff'],
                ];
            @endphp

            @foreach($users as $user)
            <tr x-data="{ name: '{{ $user['name'] }}', email: '{{ $user['email'] }}', username: '{{ $user['username'] }}', role: '{{ $user['role'] }}' }" :class="editUserId === '{{ $user['id'] }}' ? 'table-light' : ''">
                <td class="td-checkbox"><input type="checkbox" class="form-check-input form-check-input-custom"></td>
                
                <td class="text-start">
                    <span x-show="editUserId !== '{{ $user['id'] }}'" class="text-name-bold" x-text="name"></span>
                    <input x-show="editUserId === '{{ $user['id'] }}'" x-cloak type="text" class="form-control form-editable-sm fw-bold text-dark" x-model="name">
                </td>
                
                <td class="text-start">
                    <span x-show="editUserId !== '{{ $user['id'] }}'" class="text-normal-field" x-text="email"></span>
                    <input x-show="editUserId === '{{ $user['id'] }}'" x-cloak type="text" class="form-control form-editable-sm" x-model="email">
                </td>
                
                <td class="text-start">
                    <span x-show="editUserId !== '{{ $user['id'] }}'" class="text-normal-field" x-text="username"></span>
                    <input x-show="editUserId === '{{ $user['id'] }}'" x-cloak type="text" class="form-control form-editable-sm" x-model="username">
                </td>
                
                <td class="text-start">
                    <span x-show="editUserId !== '{{ $user['id'] }}'" class="text-normal-field" x-text="role"></span>
                    <select x-show="editUserId === '{{ $user['id'] }}'" x-cloak class="form-select select-editable-sm" x-model="role">
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                    </select>
                </td>
                
                <td>
                    <div class="action-icons-box">
                        <i x-show="editUserId !== '{{ $user['id'] }}'" class="fa-solid fa-pen icon-edit-grey" @click="editUserId = '{{ $user['id'] }}'"></i>
                        <i x-show="editUserId !== '{{ $user['id'] }}'" class="fa-solid fa-trash-can icon-delete-red"></i>
                        
                        <button x-show="editUserId === '{{ $user['id'] }}'" x-cloak class="btn-submit-save-user" @click="editUserId = null">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-pagination-staff">
        <div>Rows per page: 1-10 of 140 rows</div>
        <div class="pg-staff-container">
            <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
            <a href="#" class="active-pg-box">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <span style="color: rgba(255,255,255,0.4)">...</span>
            <a href="#">14</a>
            <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
        </div>
    </div>
</div>
@endsection