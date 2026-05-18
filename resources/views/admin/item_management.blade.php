@extends('layouts.app')

@section('title', 'Item Management (Admin) - SIGMA')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    /* Reset Spacing Content Body */
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

    /* Alert Sukses Elegan di Atas Search Bar */
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

    /* 2. Search & Filter Action Bar */
    .search-action-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
        gap: 20px;
    }
    .left-action-controls {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-grow: 1;
    }
    .search-wrapper {
        position: relative;
        max-width: 280px;
        width: 100%;
    }
    .search-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    .search-wrapper .form-control {
        padding: 10px 15px 10px 42px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        font-size: 13px;
        background-color: #ffffff;
    }

    /* Kapsul Kotak Dropdown Filter */
    .search-by-group {
        display: flex;
        align-items: center;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        overflow: hidden;
        background-color: #ffffff;
    }
    .search-by-label-box {
        background-color: #f9fafb;
        color: #374151;
        padding: 10px 15px;
        font-size: 13px;
        font-weight: 600;
        border-right: 1px solid #d1d5db;
        white-space: nowrap;
    }
    .dropdown-filter-select {
        border: none;
        background-color: #ffffff;
        color: #374151;
        font-weight: 600;
        font-size: 13px;
        padding: 10px 30px 10px 15px;
        cursor: pointer;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234b5563' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 14px;
    }

    /* 3. Table Layout Zebra Striping */
    .table-card-staff {
        background-color: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .staff-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .staff-table thead th {
        background-color: #3f3d8f;
        color: #ffffff;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.8px;
        padding: 18px 20px;
        border: none;
    }
    .staff-table td {
        padding: 22px 20px;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
        color: #4b5563;
    }
    .staff-table tbody tr:nth-child(even) {
        background-color: #f9fafb;
    }

    /* Actions Layout Alignment (Flexbox Anti-Melorot) */
    .action-container-cell {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 34px;
    }
    .action-normal-layout, .action-edit-layout {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 16px;
    }
    
    .icon-pen-grey { color: #9ca3af !important; cursor: pointer; }
    .icon-pen-grey:hover { color: #4b5563 !important; }
    
    .icon-trash-red { color: #ef4444 !important; cursor: pointer; z-index: 10; position: relative; }
    .icon-trash-red:hover { color: #dc2626 !important; }

    /* Input Field Spinner Qty Pas Klik Edit */
    .qty-number-browser {
        width: 65px;
        height: 32px;
        padding: 4px 6px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-weight: 700;
        font-size: 14px;
        text-align: center;
        outline: none;
    }
    
    /* Centang Hijau Buat Simpan */
    .btn-submit-green-circle {
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

    /* Footer Purple Bar */
    .footer-purple-bar {
        background-color: #2e2a85;
        color: #ffffff;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
    }
    .pg-container { display: flex; gap: 6px; align-items: center; }
    .pg-container a { color: rgba(255, 255, 255, 0.6); text-decoration: none; padding: 4px 10px; font-weight: 600; }
    .active-page-box { background-color: #2563eb; color: #ffffff !important; border-radius: 4px; }

    /* MODAL CONFIRMATION POPUP DELETE */
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

    [x-cloak] { display: none !important; }
</style>

<div x-data="{ openDeleteModal: false, showNotification: false, successMessage: '', targetItemName: '', targetItemId: '', editingId: null }">

    <h2 class="page-title-center">Item Management</h2>

    <div class="alert-success-figma" x-show="showNotification" x-transition.opacity x-cloak>
        <i class="fa-solid fa-circle-check"></i>
        <span x-text="successMessage"></span>
    </div>

    <div class="search-action-bar">
        <div class="left-action-controls">
            <div class="search-wrapper">
                <i class="fa-solid fa-search"></i>
                <input type="text" class="form-control" placeholder="Search">
            </div>
            
            <div class="search-by-group">
                <div class="search-by-label-box">Search By:</div>
                <select class="dropdown-filter-select">
                    <option value="item">Item</option>
                    <option value="category">Category Item</option>
                    <option value="stock">Stock Item</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-card-staff">
        <table class="staff-table text-center align-middle">
            <thead>
                <tr>
                    <th style="width: 35%;" class="text-start ps-5">Nama Item</th>
                    <th style="width: 25%;" class="text-start">Category Item</th>
                    <th style="width: 15%;" class="text-start">Stock Item</th>
                    <th style="width: 25%;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $items = [
                        ['id' => 'i1', 'name' => 'Oli Mesin Super', 'cat' => 'Spare Part Leopard', 'stock' => 120],
                        ['id' => 'i2', 'name' => 'Uranium-235 Murni', 'cat' => 'Bahan Nuklir', 'stock' => 4],
                        ['id' => 'i3', 'name' => 'Iphone 15 Pro Max', 'cat' => 'Elektronik', 'stock' => 40],
                        ['id' => 'i4', 'name' => 'Pelor Kaliber 5.56mm', 'cat' => 'Persenjataan ABRI', 'stock' => 1500],
                        ['id' => 'i5', 'name' => 'Router Starlink Gen 3', 'cat' => 'Elektronik', 'stock' => 30],
                    ];
                @endphp

                @foreach($items as $item)
                <tr>
                    <td class="text-start ps-5 fw-bold" style="color: #111827;">{{ $item['name'] }}</td>
                    <td class="text-start" style="color: #4b5563; font-weight: 500;">{{ $item['cat'] }}</td>
                    <td class="text-start font-weight-bold" style="color: #111827; font-weight: 700;">{{ $item['stock'] }}</td>
                    <td>
                        <div class="action-container-cell">
                            
                            <div class="action-normal-layout" x-show="editingId !== '{{ $item['id'] }}'">
                                <i class="fa-solid fa-pen icon-pen-grey" @click="editingId = '{{ $item['id'] }}'"></i>
                            </div>

                            <div class="action-edit-layout" x-show="editingId === '{{ $item['id'] }}'" x-cloak>
                                <i class="fa-solid fa-pen icon-pen-grey" style="color: #4b5563 !important;" @click="editingId = null"></i>
                                
                                <i class="fa-solid fa-trash-can icon-trash-red" @click="targetItemName = '{{ $item['name'] }}'; targetItemId = '{{ $item['id'] }}'; openDeleteModal = true"></i>
                                
                                <form class="d-flex align-items-center gap-2" @submit.prevent="editingId = null; successMessage = 'Stok {{ $item['name'] }} sukses diperbarui!'; showNotification = true; setTimeout(() => showNotification = false, 3000)">
                                    <input type="number" class="qty-number-browser" value="{{ $item['stock'] }}" min="0">
                                    <button type="submit" class="btn-submit-green-circle" title="Simpan Perubahan">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer-purple-bar">
            <div>Rows per page: 10 | 1-5 of 5 rows</div>
            <div class="pg-container">
                <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
                <a href="#" class="active-page-box">1</a>
                <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

    <div class="modal-overlay-delete" x-show="openDeleteModal" x-transition.opacity x-cloak>
        <div class="modal-card-delete" @click.away="openDeleteModal = false" x-transition.scale>
            <div class="icon-warning-box"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="delete-modal-title">Yakin mau menghapus barang ini?</div>
            <div class="delete-modal-text">
                Barang <strong class="text-dark" x-text="'“' + targetItemName + '”'"></strong> bakal di hapus dari sistem.
            </div>
            <div class="d-flex justify-content-center gap-3">
                <button type="button" class="btn-modal-action btn-cancel-grey" @click="openDeleteModal = false">Batal</button>
                <button type="button" class="btn-modal-action btn-confirm-red" @click="openDeleteModal = false; successMessage = 'Barang ' + targetItemName + ' resmi didepak dari database!'; showNotification = true; setTimeout(() => showNotification = false, 3500)">
                    HAPUS
                </button>
            </div>
        </div>
    </div>

</div>
@endsection