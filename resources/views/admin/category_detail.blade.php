@extends('layouts.app')

@section('title', 'Detail Category - SIGMA')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    /* Reset & Alignment Background Dashboard utama agar klop dengan Figma */
    .content-body { 
        padding: 40px 50px !important; 
        background-color: #f4f5f9; 
    }

    /* 1. Tombol Kembali Kapsul Biru Muda Pudar (Return to Category) */
    .btn-return-figma { 
        background-color: #bfdbfe; 
        color: #2563eb; 
        border: none; 
        padding: 6px 18px; 
        border-radius: 50px; 
        font-size: 13px; 
        font-weight: 700; 
        text-decoration: none; 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .btn-return-figma i { transform: rotate(180deg); }

    /* 2. Section Header Judul Tengah */
    .detail-header-section { 
        text-align: center; 
        margin-top: -10px; 
        margin-bottom: 35px; 
    }
    .detail-header-section h2 { 
        font-size: 32px; 
        font-weight: 800; 
        color: #1e1b4b; 
        margin: 0; 
    }
    .detail-header-section p { 
        font-size: 26px; 
        color: #1e1b4b; 
        font-weight: 600; 
        margin-top: 5px; 
        margin-bottom: 0; 
    }

    /* KUNCI NOTIFIKASI: Alert Hijau yang Muncul di Atas Search Bar */
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

    /* 3. Action Control Bar (Search di kiri, Add Item di kanan) */
    .action-bar-detail { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 25px; 
    }
    .search-detail-wrapper { 
        position: relative; 
        width: 280px; 
    }
    .search-detail-wrapper i { 
        position: absolute; 
        left: 15px; 
        top: 50%; 
        transform: translateY(-50%); 
        color: #9ca3af; 
    }
    .search-detail-wrapper .form-control { 
        padding: 10px 15px 10px 42px; 
        border-radius: 8px; 
        border: 1px solid #d1d5db; 
        background-color: #ffffff;
        font-size: 13px;
    }
    .btn-add-item-dark { 
        background-color: #1e1b4b; 
        color: #ffffff; 
        border: none; 
        padding: 10px 24px; 
        border-radius: 8px; 
        font-weight: 700; 
        font-size: 13px; 
        cursor: pointer; 
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    /* 4. Tabel Card Wrapper & Zebra Striping 1:1 */
    .table-container-detail { 
        background-color: #ffffff; 
        border-radius: 12px; 
        overflow: hidden; 
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02); 
    }
    .table-detail { 
        width: 100%; 
        border-collapse: collapse; 
        font-size: 13px; 
    }
    .table-detail thead th { 
        background-color: #3f3d8f; 
        color: #ffffff; 
        padding: 20px; 
        font-weight: 700;
        font-size: 11px; 
        text-transform: uppercase; 
        letter-spacing: 0.8px;
        border: none;
    }
    .table-detail tbody td { 
        padding: 22px 20px; 
        border-bottom: 1px solid #f1f5f9; 
        vertical-align: middle; 
    }
    .table-detail tbody tr:nth-child(even) {
        background-color: #f8fafc;
    }

    /* Typography Isi Tabel */
    .text-item-name { font-weight: 700; color: #1e293b; font-size: 14px; }
    .text-item-stock { font-weight: 500; color: #64748b; font-size: 14px; }

    /* 5. Alignment Kolom ACTIONS */
    .action-wrapper-cell { 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        min-height: 36px; 
    }
    .action-direct-form {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    /* Icon Buttons Static & Action styling */
    .icon-pajangan-grey { 
        color: #9ca3af !important; 
        font-size: 16px;
        cursor: default;
    }
    .icon-trash-red { 
        color: #ef4444 !important; 
        cursor: pointer; 
        border: none; 
        background: none; 
        padding: 0; 
        font-size: 16px; 
    }
    .icon-trash-red:hover { color: #dc2626 !important; }
    
    /* Input Spinner Angka Standby */
    .qty-number-input { 
        width: 70px; 
        height: 34px; 
        padding: 4px 8px; 
        border: 1px solid #cbd5e1; 
        border-radius: 6px; 
        font-weight: 700; 
        text-align: center; 
        outline: none; 
        color: #334155;
    }
    
    /* Tombol Centang Bulat Hijau */
    .btn-submit-check { 
        background-color: #22c55e; 
        color: #ffffff; 
        width: 30px; 
        height: 30px; 
        border-radius: 50%; 
        border: none; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        cursor: pointer; 
        font-size: 13px;
        box-shadow: 0 2px 5px rgba(34, 197, 94, 0.3); 
        transition: transform 0.1s;
    }
    .btn-submit-check:hover { transform: scale(1.05); background-color: #16a34a; }

    /* 6. Footer Pagination Polos Biru Gelap */
    .footer-detail { 
        background-color: #2e2a85; 
        color: #ffffff; 
        padding: 16px 24px; 
        display: flex; 
        justify-content: space-between; 
        align-items: center;
        font-size: 13px;
    }
    .pg-box-container { display: flex; gap: 5px; align-items: center; }
    .pg-box-container a { color: rgba(255,255,255,0.6); text-decoration: none; padding: 4px 10px; font-weight: 600; }
    .active-pg { background-color: #2563eb; color: white !important; border-radius: 4px; }

    [x-cloak] { display: none !important; }
</style>

<div x-data="{ showNotification: false, successMessage: '' }">

    <a href="{{ url('/admin/category-management') }}" class="btn-return-figma">
        <i class="fa-solid fa-arrow-right-from-bracket"></i> Return to Category
    </a>

    <div class="detail-header-section">
        <h2>Detail Category</h2>
        <p>“Elektronik”</p>
    </div>

    <div class="alert-success-figma" x-show="showNotification" x-transition.opacity x-cloak>
        <i class="fa-solid fa-circle-check"></i>
        <span x-text="successMessage"></span>
    </div>

    <div class="action-bar-detail">
        <div class="search-detail-wrapper">
            <i class="fa-solid fa-search"></i>
            <input type="text" class="form-control" placeholder="Search">
        </div>
        <button class="btn-add-item-dark">Add Item</button>
    </div>

    <div class="table-container-detail">
        <table class="table-detail mb-0 text-center">
            <thead>
                <tr>
                    <th class="text-start ps-5" style="width: 40%;">Nama Item</th>
                    <th class="text-start" style="width: 30%;">Stock Item</th>
                    <th style="width: 30%;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $dummy_items = [
                        ['id' => 'i1_1', 'name' => 'Spark Plug', 'stock' => 300],
                        ['id' => 'i1_2', 'name' => 'Spark Plug', 'stock' => 300],
                        ['id' => 'i2_1', 'name' => 'Charger Laptop', 'stock' => 2598],
                        ['id' => 'i2_2', 'name' => 'Charger Laptop', 'stock' => 2598],
                        ['id' => 'i3_1', 'name' => 'Iphone 15', 'stock' => 87],
                        ['id' => 'i3_2', 'name' => 'Iphone 15', 'stock' => 87],
                        ['id' => 'i4_1', 'name' => 'Air Conditioner Porsche', 'stock' => 23],
                        ['id' => 'i4_2', 'name' => 'Air Conditioner Porsche', 'stock' => 23],
                        ['id' => 'i5_1', 'name' => 'Router Starlink', 'stock' => 44],
                        ['id' => 'i5_2', 'name' => 'Router Starlink', 'stock' => 44],
                    ];
                @endphp

                @foreach($dummy_items as $item)
                <tr>
                    <td class="text-start ps-5 text-item-name">{{ $item['name'] }}</td>
                    <td class="text-start text-item-stock">{{ $item['stock'] }}</td>
                    <td>
                        <div class="action-wrapper-cell">
                            
                            <div class="action-direct-form">
                                <i class="fa-solid fa-pen icon-pajangan-grey"></i>

                                <button type="button" class="icon-trash-red" @click="successMessage = 'Item {{ $item['name'] }} sukses didepak!'; showNotification = true; setTimeout(() => showNotification = false, 3000)">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                
                                <form class="d-flex align-items-center gap-2" @submit.prevent="successMessage = 'Stok {{ $item['name'] }} berhasil diperbarui!'; showNotification = true; setTimeout(() => showNotification = false, 3000)">
                                    <input type="number" class="qty-number-input" value="2" min="0">
                                    <button type="submit" class="btn-submit-check" title="Simpan Perubahan">
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
        
        <div class="footer-detail">
            <div>Rows per page: 1-10 of 140 rows</div>
            <div class="pg-box-container">
                <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
                <a href="#" class="active-pg">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <span style="color: rgba(255,255,255,0.4)">...</span>
                <a href="#">14</a>
                <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

</div>
@endsection