@extends('layouts.app')

@section('title', 'Item Management - SIGMA')

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

    /* KUNCI NOTIFIKASI: Alert Hijau Elegan di Atas Search Bar */
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

    /* 2. Search & Top Action Bar */
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

    /* 3. Table Layout */
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

    /* Actions Inline Edit */
    .action-container-cell {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 32px;
    }
    .action-normal-layout, .action-edit-layout {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 16px;
    }
    .icon-pen-grey { color: #9ca3af !important; cursor: pointer; }
    .qty-number-browser {
        width: 65px;
        padding: 4px 6px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-weight: 700;
        font-size: 14px;
        text-align: center;
        outline: none;
    }
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

    .footer-purple-bar {
        background-color: #2e2a85;
        color: #ffffff;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
    }
    .pg-container {
        display: flex; gap: 6px; align-items: center;
    }
    .pg-container a {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        padding: 4px 10px;
        font-weight: 600;
    }
    .active-page-box {
        background-color: #2563eb;
        color: #ffffff !important;
        border-radius: 4px;
    }

    [x-cloak] { display: none !important; }
</style>

<div x-data="{ showNotification: false, successMessage: '' }">

    <h2 class="page-title-center">Item Management</h2>

    <div class="alert-success-figma" x-show="showNotification" x-transition.opacity x-cloak>
        <i class="fa-solid fa-circle-check"></i>
        <span x-text="successMessage"></span>
    </div>

    <div class="search-action-bar">
        <div class="left-action-controls">
            <form method="GET" action="{{ route('Item') }}" class="d-flex align-items-center gap-3" style="flex-grow:1;">
            <div class="search-wrapper">
                <i class="fa-solid fa-search"></i>
                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
            </div>
            
            <div class="search-by-group">
                <div class="search-by-label-box">Search By:</div>
                <select name="search_by" class="dropdown-filter-select" onchange="this.form.submit()">
                    <option value="item" {{ request('search_by') == 'item' ? 'selected' : '' }}>Item</option>
                    <option value="category" {{ request('search_by') == 'category' ? 'selected' : '' }}>Category Item</option>
                </select>
            </div>
            </form>
        </div>
        </div>

    <div class="table-card-staff" x-data="{ editingId: null }">
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
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td class="text-start ps-5 fw-bold" style="color: #111827;">{{ $item->item_name }}</td>
                    <td class="text-start" style="color: #4b5563; font-weight: 500;">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td class="text-start font-weight-bold" style="color: #111827; font-weight: 700;">{{ $item->item_qty }}</td>
                    <td>
                        <div class="action-container-cell">
                            <div class="action-normal-layout" x-show="editingId !== {{ $item->id }}">
                                <i class="fa-solid fa-pen icon-pen-grey" @click="editingId = {{ $item->id }}"></i>
                            </div>

                            <div class="action-edit-layout" x-show="editingId === {{ $item->id }}" x-cloak>
                                <i class="fa-solid fa-pen icon-pen-grey" style="color: #4b5563 !important;"></i>
                                <form method="POST" action="{{ route('itemProcess') }}" class="d-flex align-items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <select name="jenis_mutasi" class="form-select form-select-sm" style="width:100px;">
                                        <option value="Increase">+ Tambah</option>
                                        <option value="Decrease">- Kurang</option>
                                    </select>
                                    <input type="number" name="perubahan_qty" class="qty-number-browser" value="1" min="1">
                                    <button type="submit" class="btn-submit-green-circle" title="Simpan Perubahan">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">Belum ada data barang</td>
                </tr>
                @endforelse
            </tbody>
            </tbody>
        </table>

        <div class="footer-purple-bar">
            <div>Rows per page: 10 | {{ $items->firstItem() }}-{{ $items->lastItem() }} of {{ $items->total() }} rows</div>
            <div class="pg-container">
                <a href="{{ $items->previousPageUrl() }}"><i class="fa-solid fa-chevron-left"></i></a>
                @foreach($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="{{ $page == $items->currentPage() ? 'active-page-box' : '' }}">{{ $page }}</a>
                @endforeach
                <a href="{{ $items->nextPageUrl() }}"><i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

    </div>
@endsection