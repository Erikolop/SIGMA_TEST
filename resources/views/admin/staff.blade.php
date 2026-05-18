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

    /* Alert Hijau Elegan di Atas Search Bar */
    .alert-success-figma {
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
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
    
    /* Bungkus tombol kanan agar flex layout tetap rapi */
    .right-action-buttons {
        display: flex;
        align-items: center;
        gap: 12px;
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
        cursor: pointer;
    }
    
    /* TOMBOL BARU: Gaya Hapus Massal Figma (Merah Lembut Elegan) */
    .btn-delete-selected {
        background-color: #fee2e2;
        color: #991b1b;
        font-size: 12px;
        font-weight: 700;
        padding: 11px 20px;
        border-radius: 8px;
        border: 1px solid #fca5a5;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.05);
    }
    .btn-delete-selected:hover {
        background-color: #ffeeee;
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
    
    /* Row Highlight pas dicentang */
    .row-selected-highlight {
        background-color: #eff6ff !important;
    }

    /* Checkbox */
    .td-checkbox { width: 60px; }
    .form-check-input-custom {
        width: 16px; height: 16px; cursor: pointer; border: 1px solid #d1d5db; border-radius: 4px;
    }

    /* Teks Normal */
    .text-name-bold { font-weight: 700; color: #111827; }
    .text-normal-field { font-weight: 500; color: #4b5563; }

    /* Actions Style */
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

    /* PopUp Modal Style Khas Figma (Add & Edit) */
    .modal-overlay-custom {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(30, 41, 59, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
    .modal-card-custom {
        background-color: #ffffff;
        width: 500px;
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* MODAL CONFIRMATION POPUP DELETE STAFF ACC */
    .modal-overlay-delete {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(30, 41, 59, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
    .modal-card-delete {
        background-color: #ffffff;
        width: 450px;
        border-radius: 14px;
        padding: 35px;
        text-align: center;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
    }
    .icon-warning-box { color: #ef4444; font-size: 48px; margin-bottom: 15px; }
    .delete-modal-title { color: #1e293b; font-size: 18px; font-weight: 700; margin-bottom: 10px; }
    .delete-modal-text { color: #64748b; font-size: 13px; line-height: 1.5; margin-bottom: 25px; }
    
    .btn-modal-action { padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; }
    .btn-cancel-grey { background-color: #f1f5f9; color: #475569; }
    .btn-cancel-grey:hover { background-color: #e2e8f0; }
    .btn-confirm-red { background-color: #ef4444; color: #ffffff; }
    .btn-confirm-red:hover { background-color: #dc2626; }

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
    .pg-staff-container { display: flex; gap: 6px; align-items: center; }
    .pg-staff-container a { color: rgba(255, 255, 255, 0.6); text-decoration: none; padding: 4px 10px; font-weight: 600; }
    .active-pg-box { background-color: #2563eb; color: #ffffff !important; border-radius: 4px; }
    
    [x-cloak] { display: none !important; }
</style>

@php
    // Definisikan array list data user di PHP level atas agar sinkron dengan inisialisasi Alpine ID
    $dummy_users = [
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
    // Ambil string daftar id buat fungsi select all
    $all_ids = json_encode(array_column($dummy_users, 'id'));
@endphp

<div x-data="{ 
    openAddModal: false, 
    openEditModal: false, 
    openDeleteModal: false,
    openBulkDeleteModal: false,
    showNotification: false, 
    successMessage: '',
    targetStaffName: '',
    targetStaffId: '',
    selectedUsers: [], 
    allUserIds: {{ $all_ids }},
    editData: { id: '', name: '', email: '', username: '', role: '' },
    
    // Fungsi pembantu select all checkbox
    toggleAll() {
        if (this.selectedUsers.length === this.allUserIds.length) {
            this.selectedUsers = [];
        } else {
            this.selectedUsers = [...this.allUserIds];
        }
    }
}">
    
    <h2 class="page-title-center">Staff Management</h2>

    <div class="alert-success-figma" x-show="showNotification" x-transition.opacity x-cloak>
        <i class="fa-solid fa-circle-check"></i>
        <span x-text="successMessage"></span>
    </div>

    <div class="action-bar-staff">
        <div class="search-box-staff">
            <i class="fa-solid fa-search"></i>
            <input type="text" class="form-control" placeholder="Search">
        </div>
        
        <div class="right-action-buttons">
            <button x-show="selectedUsers.length > 0" x-transition x-cloak class="btn-delete-selected shadow-sm" @click="openBulkDeleteModal = true">
                <i class="fa-solid fa-trash-sweep"></i> Delete Selected (<span x-text="selectedUsers.length"></span>)
            </button>
            
            <button class="btn-add-user shadow-sm" @click="openAddModal = true">
                <i class="fa-solid fa-user-plus"></i> Add User
            </button>
        </div>
    </div>

    <div class="table-wrapper-staff">
        <table class="staff-table-admin text-center align-middle">
            <thead>
                <tr>
                    <th class="td-checkbox">
                        <input type="checkbox" class="form-check-input form-check-input-custom" 
                               @click="toggleAll()" 
                               :checked="selectedUsers.length === allUserIds.length && allUserIds.length > 0">
                    </th>
                    <th style="width: 20%;" class="text-start">Full Name</th>
                    <th style="width: 25%;" class="text-start">Email</th>
                    <th style="width: 15%;" class="text-start">Username</th>
                    <th style="width: 15%;" class="text-start">Role</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dummy_users as $u)
                <tr :class="selectedUsers.includes('{{ $u['id'] }}') ? 'row-selected-highlight' : ''">
                    
                    <td class="td-checkbox">
                        <input type="checkbox" value="{{ $u['id'] }}" class="form-check-input form-check-input-custom" x-model="selectedUsers">
                    </td>
                    
                    <td class="text-start text-name-bold">{{ $u['name'] }}</td>
                    <td class="text-start text-normal-field">{{ $u['email'] }}</td>
                    <td class="text-start text-normal-field">{{ $u['username'] }}</td>
                    <td class="text-start text-normal-field">{{ $u['role'] }}</td>
                    
                    <td>
                        <div class="action-icons-box">
                            <i class="fa-solid fa-pen icon-edit-grey" @click="editData = { id: '{{ $u['id'] }}', name: '{{ $u['name'] }}', email: '{{ $u['email'] }}', username: '{{ $u['username'] }}', role: '{{ $u['role'] }}' }; openEditModal = true"></i>
                            <i class="fa-solid fa-trash-can icon-delete-red" @click="targetStaffName = '{{ $u['name'] }}'; targetStaffId = '{{ $u['id'] }}'; openDeleteModal = true"></i>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal-overlay-custom" x-show="openAddModal" x-transition.opacity x-cloak>
        <div class="modal-card-custom" @click.away="openAddModal = false" x-transition.scale>
            <h4 class="text-center mb-4" style="color: #3f3d8f; font-weight: 700;">ADD NEW USER</h4>
            
            <form x-data="{ newName: '' }" @submit.prevent="openAddModal = false; successMessage = 'Akun baru untuk ' + newName + ' sukses terdaftar!'; showNotification = true; setTimeout(() => showNotification = false, 3500); newName = ''">
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Full Name</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama lengkap" x-model="newName" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Email</label>
                    <input type="email" class="form-control" placeholder="Contoh: user@gmail.com" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Username</label>
                    <input type="text" class="form-control" placeholder="Masukkan username baru" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Role</label>
                    <select class="form-select">
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary" style="font-size: 13px; font-weight: 600;" @click="openAddModal = false">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #3f3d8f; border: none; font-size: 13px; font-weight: 600;">Create</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay-custom" x-show="openEditModal" x-transition.opacity x-cloak>
        <div class="modal-card-custom" @click.away="openEditModal = false" x-transition.scale>
            <h4 class="text-center mb-4" style="color: #3f3d8f; font-weight: 700;">EDIT USER ACCOUNT</h4>
            
            <form @submit.prevent="openEditModal = false; successMessage = 'Perubahan data ' + editData.name + ' berhasil disimpan!'; showNotification = true; setTimeout(() => showNotification = false, 3500)">
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Full Name</label>
                    <input type="text" class="form-control" x-model="editData.name" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Email</label>
                    <input type="email" class="form-control" x-model="editData.email" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Username</label>
                    <input type="text" class="form-control" x-model="editData.username" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Role</label>
                    <select class="form-select" x-model="editData.role">
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary" style="font-size: 13px; font-weight: 600;" @click="openEditModal = false">Cancel</button>
                    <button type="submit" class="btn btn-success" style="background-color: #22c55e; border: none; font-size: 13px; font-weight: 600;">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay-delete" x-show="openDeleteModal" x-transition.opacity x-cloak>
        <div class="modal-card-delete" @click.away="openDeleteModal = false" x-transition.scale>
            <div class="icon-warning-box"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="delete-modal-title">Yakin mau ngehapus akun ini?</div>
            <div class="delete-modal-text">
                Akun staff <strong class="text-dark" x-text="'“' + targetStaffName + '”'"></strong> bakal dihapus permanen dari sistem SIGMA dan bakal menghantui random sabila mustaqeemm, aamiinn.
            </div>
            <div class="d-flex justify-content-center gap-3">
                <button type="button" class="btn-modal-action btn-cancel-grey" @click="openDeleteModal = false">Batal</button>
                <button type="button" class="btn-modal-action btn-confirm-red" @click="openDeleteModal = false; successMessage = 'Akun ' + targetStaffName + ' resmi dihapus dari database!'; showNotification = true; setTimeout(() => showNotification = false, 3500)">
                    Yoi, Hapus!
                </button>
            </div>
        </div>
    </div>

    <div class="modal-overlay-delete" x-show="openBulkDeleteModal" x-transition.opacity x-cloak>
        <div class="modal-card-delete" @click.away="openBulkDeleteModal = false" x-transition.scale>
            <div class="icon-warning-box"><i class="fa-solid fa-dumpster-fire"></i></div>
            <div class="delete-modal-title">Yakin mau membumi hanguskan akun-akun ini?</div>
            <div class="delete-modal-text">
                Kamu milih <strong class="text-danger" x-text="selectedUsers.length + ' akun staff'"></strong> sekaligus. Semuanya bakal dihanguskan permanen dari database SIGMA!
            </div>
            <div class="d-flex justify-content-center gap-3">
                <button type="button" class="btn-modal-action btn-cancel-grey" @click="openBulkDeleteModal = false">Batal</button>
                <button type="button" class="btn-modal-action btn-confirm-red" @click="openBulkDeleteModal = false; successMessage = selectedUsers.length + ' Akun staff sukses dibumihanguskan bersamaan!'; selectedUsers = []; showNotification = true; setTimeout(() => showNotification = false, 4000)">
                    Yoi, Babat Semua!
                </button>
            </div>
        </div>
    </div>

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

</div> @endsection