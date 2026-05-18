@extends('layouts.app')

@section('title', 'Category Management - SIGMA')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    .content-body { padding: 30px 40px !important; background-color: #f4f5f9; }
    .page-title-center { text-align: center; font-size: 28px; font-weight: 800; color: #1e1b4b; margin-bottom: 40px; }
    
    /* 1. Action Bar Atas */
    .action-bar-category { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .search-box-category { position: relative; max-width: 280px; width: 100%; }
    .search-box-category i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; }
    .search-box-category .form-control { padding: 10px 15px 10px 42px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px; background-color: #ffffff; }
    
    /* Tombol Add Category Biru Gelap 1:1 Sesuai Foto */
    .btn-add-category-dark {
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
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    /* FIX SINKRON: Alert Sukses Hijau Elegan Tepat di Atas Search Bar */
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
    
    /* 2. Tabel Layout 1:1 Mockup Terbaru */
    .table-wrapper-category { background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    .category-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .category-table thead th { background-color: #3f3d8f; color: #ffffff; font-weight: 700; text-transform: uppercase; padding: 18px 20px; border: none; letter-spacing: 0.8px; }
    .category-table td { padding: 20px; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
    .category-table tbody tr:nth-child(even) { background-color: #f9fafb; }
    
    /* Alignment Icon Box Actions */
    .action-icons-box {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 18px;
        font-size: 16px;
    }
    
    /* JEMBATAN AMAN: Icon Pena Abu Tetap Berfungsi Sebagai Link murni tanpa merubah struktur */
    .icon-link-detail { color: #9ca3af !important; text-decoration: none; cursor: pointer; transition: 0.2s; }
    .icon-link-detail:hover { color: #2563eb !important; }
    
    /* Icon Trash Merah Berdampingan Rapi */
    .icon-trash-action { color: #ef4444 !important; cursor: pointer; transition: 0.2s; }
    .icon-trash-action:hover { color: #dc2626 !important; }

    /* 3. PopUp Modal Layout (Add & Delete) */
    .modal-overlay-custom {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(30, 41, 59, 0.6);
        display: flex; align-items: center; justify-content: center;
        z-index: 9999;
    }
    .modal-card-custom {
        background-color: #ffffff;
        width: 500px;
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }
    
    /* Modal Card Delete Khusus (SAMA PERSIS DENGAN STAFF) */
    .modal-overlay-delete {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(30, 41, 59, 0.6);
        display: flex; align-items: center; justify-content: center;
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

    .footer-purple-bar { background-color: #2e2a85; color: #ffffff; padding: 15px 20px; display: flex; justify-content: space-between; font-size: 13px; }
    .pg-container-box { display: flex; gap: 5px; align-items: center; }
    .pg-container-box a { color: rgba(255, 255, 255, 0.6); text-decoration: none; padding: 4px 10px; font-weight: 600; }
    .active-page-box { background-color: #2563eb; color: #ffffff !important; border-radius: 4px; }

    [x-cloak] { display: none !important; }
</style>

<div x-data="{ openAddModal: false, openDeleteModal: false, showNotification: false, successMessage: '', targetCatName: '', targetCatId: '' }">

    <h2 class="page-title-center">Category Management</h2>

    <div class="alert-success-figma" x-show="showNotification" x-transition.opacity x-cloak>
        <i class="fa-solid fa-circle-check"></i>
        <span x-text="successMessage"></span>
    </div>

    <div class="action-bar-category">
        <div class="search-box-category">
            <i class="fa-solid fa-search"></i>
            <input type="text" class="form-control" placeholder="Search">
        </div>
        
        <button type="button" class="btn-add-category-dark shadow-sm" @click="openAddModal = true">
            <i class="fa-solid fa-user-plus"></i> Add Category
        </button>
    </div>

    <div class="table-wrapper-category">
        <table class="category-table text-center align-middle">
            <thead>
                <tr>
                    <th style="width: 25%;">ID</th>
                    <th style="width: 45%;" class="text-start">Category Name</th>
                    <th style="width: 30%;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $dummy_categories = [
                        ['id' => 'category_01', 'name' => 'Logam'],
                        ['id' => 'category_01', 'name' => 'Logam'],
                        ['id' => 'category_02', 'name' => 'Elektronik'],
                        ['id' => 'category_02', 'name' => 'Elektronik'],
                        ['id' => 'category_03', 'name' => 'Bahan Nuklir'],
                        ['id' => 'category_03', 'name' => 'Bahan Nuklir'],
                        ['id' => 'category_04', 'name' => 'Persenjataan ABRI'],
                        ['id' => 'category_04', 'name' => 'Persenjataan ABRI'],
                        ['id' => 'category_05', 'name' => 'Spare Part Leopard'],
                        ['id' => 'category_05', 'name' => 'Spare Part Leopard'],
                    ];
                @endphp

                @foreach($dummy_categories as $cat)
                <tr>
                    <td class="fw-bold" style="color: #111827;">{{ $cat['id'] }}</td>
                    
                    <td class="text-start font-weight-medium" style="color: #4b5563;">{{ $cat['name'] }}</td>
                    
                    <td>
                        <div class="action-icons-box">
                            <a href="{{ url('/admin/category-detail') }}" class="icon-link-detail" title="Lihat Detail Kategori">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            
                            <i class="fa-solid fa-trash-can icon-trash-action" @click="targetCatName = '{{ $cat['name'] }}'; openDeleteModal = true"></i>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="footer-purple-bar">
            <div>Rows per page: 10 | 1-10 of 140 rows</div>
            <div class="pg-container-box">
                <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
                <a href="#" class="active-page-box">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <span style="color: rgba(255,255,255,0.4)">...</span>
                <a href="#">14</a>
                <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

    <div class="modal-overlay-custom" x-show="openAddModal" x-transition.opacity x-cloak>
        <div class="modal-card-custom" @click.away="openAddModal = false" x-transition.scale>
            <h4 class="text-center mb-4" style="color: #3f3d8f; font-weight: 700;">ADD NEW CATEGORY</h4>
            
            <form x-data="{ newCatName: '' }" @submit.prevent="openAddModal = false; successMessage = 'Kategori baru ' + newCatName + ' sukses terdaftar!'; showNotification = true; setTimeout(() => showNotification = false, 3500); newCatName = ''">
                <div class="mb-4 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px; color: #475569;">Category Name</label>
                    <input type="text" class="form-control" placeholder="Contoh: Logistik Atasan" x-model="newCatName" required>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary" style="font-size: 13px; font-weight: 600;" @click="openAddModal = false">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #3f3d8f; border: none; font-size: 13px; font-weight: 600;">Create</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay-delete" x-show="openDeleteModal" x-transition.opacity x-cloak>
        <div class="modal-card-delete" @click.away="openDeleteModal = false" x-transition.scale>
            <div class="icon-warning-box"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="delete-modal-title">Yakin mau ngehapus kategori ini?</div>
            <div class="delete-modal-text">
                Kategori <strong class="text-dark" x-text="'“' + targetCatName + '”'"></strong> bakal di depak ke kos random karna banyak revisi sukiiii.
            </div>
            <div class="d-flex justify-content-center gap-3">
                <button type="button" class="btn-modal-action btn-cancel-grey" @click="openDeleteModal = false">Batal</button>
                <button type="button" class="btn-modal-action btn-confirm-red" @click="openDeleteModal = false; successMessage = 'Kategori ' + targetCatName + ' resmi didepak dari database!'; showNotification = true; setTimeout(() => showNotification = false, 3500)">
                    Yoi, Hapus!
                </button>
            </div>
        </div>
    </div>

</div>
@endsection