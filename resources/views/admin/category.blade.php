@extends('layouts.app')

@section('title', 'Detail Category - SIGMA')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    /* Reset padding content body */
    .content-body {
        padding: 30px 40px !important;
        background-color: #f4f5f9;
    }

    /* 1. Tombol Return to Category */
    .btn-return-figma {
        background-color: #bfdbfe; 
        color: #2563eb; 
        border: none;
        padding: 6px 18px;
        border-radius: 50px; 
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }
    .btn-return-figma:hover {
        background-color: #93c5fd;
        color: #1d4ed8;
    }
    .btn-return-figma i {
        transform: rotate(180deg);
    }

    /* 2. Header Area */
    .detail-header {
        text-align: center;
        margin-top: -10px;
        margin-bottom: 40px;
    }
    .detail-header h2 {
        font-size: 32px;
        font-weight: 800;
        color: #1e1b4b;
        margin-bottom: 5px;
    }
    .detail-header p {
        font-size: 26px;
        color: #1e1b4b;
        font-weight: 600;
        margin: 0;
    }

    /* 3. Action Bar */
    .action-bar-detail {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .search-detail {
        position: relative;
        width: 280px;
    }
    .search-detail i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    .search-detail .form-control {
        padding: 10px 15px 10px 42px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        font-size: 13px;
    }
    .btn-add-item {
        background-color: #1e1b4b;
        color: white;
        border: none;
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 13px;
    }

    /* 4. Table Design */
    .table-container-detail {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .table-detail {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .table-detail thead th {
        background-color: #3f3d8f;
        color: white;
        padding: 18px 20px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
    }
    .table-detail tbody td {
        padding: 22px 20px;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
        font-size: 13px;
    }

    /* 5. FIXING CONTAINER: Kunci biar layout flex-nya rata & gak numpuk ganda */
    .action-wrapper-cell {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 32px;
    }

    /* Tampilan Normal */
    .action-normal-view {
        display: flex;
        align-items: center;
        gap: 20px;
        font-size: 16px;
    }

    /* Tampilan Edit Mode */
    .action-edit-view {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 16px;
    }

    .icon-pen-grey { color: #9ca3af !important; cursor: pointer; }
    .icon-trash-red { color: #dc2626 !important; cursor: pointer; }

    /* Input style number figma */
    .qty-number-input {
        width: 65px;
        padding: 4px 6px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-weight: 700;
        font-size: 14px;
        text-align: center;
        outline: none;
        background-color: #ffffff;
    }

    /* Tombol Centang Hijau */
    .btn-submit-check {
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

    /* 6. Footer Pagination Bar Ungu */
    .footer-detail {
        background-color: #2e2a85;
        color: white;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
    }
    .pagination-dots a {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        padding: 4px 10px;
        font-weight: 600;
    }
    .active-dot {
        background: #2563eb;
        border-radius: 4px;
        color: white !important;
    }
    
    [x-cloak] { display: none !important; }
</style>

<a href="/admin/category-management" class="btn-return-figma shadow-sm">
    <i class="fa-solid fa-arrow-right-from-bracket"></i> Return to Category
</a>

<div class="detail-header">
    <h2>Detail Category</h2>
    <p>“Elektronik”</p>
</div>

<div class="action-bar-detail">
    <div class="search-detail">
        <i class="fa-solid fa-search"></i>
        <input type="text" class="form-control" placeholder="Search">
    </div>
    <button class="btn-add-item">Add Item</button>
</div>

<div class="table-container-detail" x-data="{ editRow: null }">
    <table class="table table-detail mb-0">
        <thead>
            <tr>
                <th class="text-start ps-5" style="width: 45%;">Nama Item</th>
                <th class="text-start" style="width: 25%;">Stock Item</th>
                <th class="text-center" style="width: 30%;">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = [
                    ['id' => 'row_1', 'name' => 'Spark Plug', 'stock' => '300'],
                    ['id' => 'row_2', 'name' => 'Spark Plug', 'stock' => '300'],
                    ['id' => 'row_3', 'name' => 'Charger Laptop', 'stock' => '2598'],
                    ['id' => 'row_4', 'name' => 'Charger Laptop', 'stock' => '2598'],
                    ['id' => 'row_5', 'name' => 'Iphone 15', 'stock' => '87'],
                    ['id' => 'row_6', 'name' => 'Iphone 15', 'stock' => '87'],
                    ['id' => 'row_7', 'name' => 'Air Conditioner Porsche', 'stock' => '23'],
                    ['id' => 'row_8', 'name' => 'Air Conditioner Porsche', 'stock' => '23'],
                    ['id' => 'row_9', 'name' => 'Router Starlink', 'stock' => '44'],
                    ['id' => 'row_10', 'name' => 'Router Starlink', 'stock' => '44']
                ];
            @endphp

            @foreach($items as $item)
            <tr>
                <td class="text-start ps-5 fw-bold" style="color: #111827;">{{ $item['name'] }}</td>
                <td class="text-start" style="color: #4b5563; font-weight: 500;">{{ $item['stock'] }}</td>
                <td>
                    <div class="action-wrapper-cell">
                        <div class="action-normal-view" x-show="editRow !== '{{ $item['id'] }}'">
                            <i class="fa-solid fa-pen icon-pen-grey" @click="editRow = '{{ $item['id'] }}'"></i>
                            <i class="fa-solid fa-trash-can icon-trash-red"></i>
                        </div>

                        <div class="action-edit-view" x-show="editRow === '{{ $item['id'] }}'" x-cloak>
                            <i class="fa-solid fa-pen icon-pen-grey" style="color: #4b5563 !important;"></i>
                            <i class="fa-solid fa-trash-can icon-trash-red"></i>
                            
                            <input type="number" class="qty-number-input" value="2" min="0">
                            
                            <button class="btn-submit-check" @click="editRow = null">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-detail">
        <div>Rows per page: 10 | 1-10 of 140 rows</div>
        <div class="pagination-dots">
            <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
            <a href="#" class="active-dot">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
        </div>
    </div>
</div>
@endsection