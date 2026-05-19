@extends('layouts.app')

@section('title', 'Staff Dashboard - SIGMA')

@section('content')
<style>
    /* Card Styling Ringkasan Atas */
    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 25px;
        border: none;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        position: relative;
        height: 100%;
    }

    .stat-card.total-items {
        border-left: 5px solid #2563eb;
    }

    .stat-card.low-stock {
        border-left: 5px solid #b45309;
    }

    .stat-card .card-title-custom {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-card .card-value {
        font-size: 36px;
        font-weight: 800;
        color: #111827;
        margin-top: 5px;
    }

    .stat-card .card-icon {
        position: absolute;
        top: 25px;
        right: 25px;
        color: #9ca3af;
        font-size: 18px;
    }

    /* Banner Orange Item Management (Ukurannya pas kotak mini col-md-4) */
    .banner-manage {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border-radius: 16px;
        padding: 30px 25px; 
        color: white;
        box-shadow: 0 10px 15px -3px rgba(217, 119, 6, 0.2);
    }

    .banner-manage h4 {
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 20px; 
    }

    .btn-manage-action {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: background 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-manage-action:hover {
        background-color: rgba(255, 255, 255, 0.3);
        color: white;
    }

    /* Table Container Paling Bawah */
    .table-container {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .table-container h5 {
        font-weight: 700;
        color: #1e1b4b;
        margin-bottom: 25px;
    }

    .custom-table th {
        font-size: 11px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #f3f4f6;
        padding: 15px 10px;
    }

    .custom-table td {
        font-size: 14px;
        padding: 20px 10px;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
        color: #4b5563;
    }

    .custom-table tr:last-child td {
        border-bottom: none;
    }

    .fw-bold-dark {
        font-weight: 700;
        color: #111827;
    }

    .text-danger-custom {
        color: #dc2626;
        font-weight: 700;
    }

    .text-warning-custom {
        color: #d97706;
        font-weight: 700;
    }
</style>

<div class="container-fluid">
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card total-items">
                <span class="card-title-custom">Total Items</span>
                <div class="card-value">{{ $totalItems }}</div>
                <i class="fa-regular fa-clipboard card-icon"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card low-stock">
                <span class="card-title-custom">Low Stock</span>
                <div class="card-value">{{ $lowStock }}</div>
                <i class="fa-solid fa-triangle-exclamation card-icon"></i>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="banner-manage">
                <h4>Item Management</h4>
                <a href="/staff/item-management" class="btn-manage-action">Manage Your Item</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-container">
                <h5>Current Stock Status</h5>
                <div class="table-responsive">
                    <table class="table custom-table mb-0 text-center align-middle" style="table-layout: fixed; width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40%" class="text-start ps-3">Name</th>
                                <th style="width: 35%">Category</th>
                                <th style="width: 25%">Stock Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lowestStockItems as $item)
                            <tr>
                                <td class="fw-bold-dark text-start ps-3">{{ $item->item_name }}</td>
                                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                <td class="{{ $item->item_qty == 0 ? 'text-danger-custom' : ($item->item_qty < 20 ? 'text-warning-custom' : 'fw-bold-dark') }}">{{ $item->item_qty }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Belum ada data barang</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection