@extends('layouts.app')

@section('title', 'Activity Log - SIGMA')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    /* Reset padding bawaan content body biar tab atasnya nempel presisi */
    .content-body {
        padding: 0 !important;
    }
    
    .activity-log-wrapper {
        background-color: #ffffff;
        min-height: 100vh;
    }

    /* 1. Header Tab Oranye */
    .tab-header {
        border-bottom: 1px solid #e5e7eb;
        padding: 15px 40px 0 40px;
        background: #ffffff;
    }
    .tab-item {
        color: #f97316;
        font-weight: 700;
        font-size: 14px;
        padding-bottom: 15px;
        border-bottom: 3px solid #f97316;
        display: inline-block;
        text-decoration: none;
    }

    /* 2. Filter Area (Search & Calendar) */
    .filter-section {
        padding: 25px 40px;
        display: flex;
        gap: 15px;
        align-items: center;
    }
    .search-box-custom {
        position: relative;
        max-width: 250px;
        width: 100%;
    }
    .search-box-custom i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    .search-box-custom .form-control {
        padding: 8px 15px 8px 40px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
        background-color: #ffffff;
    }

    /* CONTAINER UTAMA FILTER KALENDER SLIDE */
    .calendar-interactive-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .calendar-click-wrapper {
        position: relative;
        display: inline-block;
    }
    .btn-calendar {
        background-color: #d1d5db;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        color: #374151;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-calendar:hover {
        background-color: #9ca3af;
    }

    /* Input date transparan di atas tombol */
    .input-date-hidden-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .input-date-hidden-overlay::-webkit-calendar-picker-indicator {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        width: 100%; height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* KOTAK KECIL HASIL SLIDE TANGGAL (Gaya Figma Clean) */
    .slide-date-badge {
        background-color: #eff6ff;
        color: #1e40af;
        border: 1px solid #bfdbfe;
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        box-shadow: 0 2px 4px rgba(37, 99, 235, 0.04);
    }
    .btn-clear-date {
        background: none;
        border: none;
        color: #93c5fd;
        cursor: pointer;
        padding: 0;
        font-size: 14px;
        display: flex;
        align-items: center;
    }
    .btn-clear-date:hover {
        color: #1e40af;
    }

    /* 3. Custom Table Activity Log */
    .table-responsive-custom {
        padding: 0 40px;
    }
    .log-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .log-table th {
        background-color: #f9fafb;
        color: #6b7280;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        padding: 12px 15px;
        border-top: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
    }
    .log-table td {
        padding: 14px 15px;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
        vertical-align: middle;
    }
    .log-table tbody tr:hover {
        background-color: #f9fafb;
    }

    /* Pewarnaan Status Dinamis */
    .text-out { color: #dc2626 !important; font-weight: 600; } /* Merah */
    .text-in { color: #16a34a !important; font-weight: 600; }  /* Hijau */
    .fw-bold-dark { font-weight: 700; color: #111827; }
    .text-muted-time { color: #6b7280; }

    /* 4. Footer Ungu Tua (Pagination Bar) */
    .footer-purple-bar {
        background-color: #2e2a85;
        color: #ffffff;
        padding: 15px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        margin-top: 40px;
    }
    .pagination-custom {
        display: flex;
        gap: 5px;
        align-items: center;
    }
    .pagination-custom a, .pagination-custom span {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 600;
    }
    .pagination-custom .active-page {
        background-color: #2563eb;
        color: #ffffff;
    }
    .pagination-custom a:hover {
        color: #ffffff;
    }

    [x-cloak] { display: none !important; }
</style>

<div class="activity-log-wrapper" x-data="{ selectedDate: '', showBadge: false }">
    <div class="tab-header">
        <a href="#" class="tab-item">Activity Logs</a>
    </div>

    <div class="filter-section">
        <div class="search-box-custom">
            <i class="fa-solid fa-search"></i>
            <input type="text" class="form-control" placeholder="Search">
        </div>
        
        <div class="calendar-interactive-container">
            <div class="calendar-click-wrapper">
                <button type="button" class="btn-calendar">
                    <i class="fa-regular fa-calendar-days fs-5"></i>
                </button>
                <input type="date" class="input-date-hidden-overlay" 
                       x-model="selectedDate"
                       @change="if(selectedDate) { showBadge = true } else { showBadge = false }">
            </div>

            <div class="slide-date-badge" 
                 x-show="showBadge" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-x-4"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform -translate-x-4"
                 x-cloak>
                <i class="fa-solid fa-filter fs-7"></i>
                <span x-text="selectedDate"></span>
                <button type="button" class="btn-clear-date" @click="selectedDate = ''; showBadge = false" title="Hapus Filter">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="table-responsive-custom">
        <table class="log-table text-center">
            <thead>
                <tr>
                    <th class="text-start" style="width: 15%;">Source</th>
                    <th style="width: 15%;">Time</th>
                    <th style="width: 15%;">User</th>
                    <th style="width: 15%;">Item</th>
                    <th style="width: 13%;">Initial</th>
                    <th style="width: 13%;">Adjustment</th>
                    <th style="width: 14%;">Remaining</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-start text-out"><i class="fa-solid fa-cart-shopping me-2"></i>Order Out</td>
                    <td class="text-muted-time">Oct 24, 14:22</td>
                    <td>Bambang</td>
                    <td>Kardus</td>
                    <td>1,240</td>
                    <td class="text-out">-150</td>
                    <td class="fw-bold-dark">1,090</td>
                </tr>
                <tr>
                    <td class="text-start text-in"><i class="fa-solid fa-cart-shopping me-2"></i>Order In</td>
                    <td class="text-muted-time">Oct 24, 11:05</td>
                    <td>Sarah</td>
                    <td>Kain</td>
                    <td>740</td>
                    <td class="text-in">+500</td>
                    <td class="fw-bold-dark">1,240</td>
                </tr>
                <tr>
                    <td class="text-start text-in"><i class="fa-solid fa-cart-shopping me-2"></i>Order In</td>
                    <td class="text-muted-time">Oct 23, 16:45</td>
                    <td>Alex</td>
                    <td>Cat</td>
                    <td>745</td>
                    <td class="text-out">-5</td>
                    <td class="fw-bold-dark">740</td>
                </tr>
                <tr>
                    <td class="text-start text-in"><i class="fa-solid fa-cart-shopping me-2"></i>Order In</td>
                    <td class="text-muted-time">Oct 23, 09:12</td>
                    <td>Kusuma</td>
                    <td>Kayu</td>
                    <td>712</td>
                    <td class="text-in">+33</td>
                    <td class="fw-bold-dark">745</td>
                </tr>
                <tr>
                    <td class="text-start text-out"><i class="fa-solid fa-cart-shopping me-2"></i>Order Out</td>
                    <td class="text-muted-time">Oct 22, 18:30</td>
                    <td>Daffa</td>
                    <td>Semen</td>
                    <td>752</td>
                    <td class="text-out">-40</td>
                    <td class="fw-bold-dark">712</td>
                </tr>
                <tr>
                    <td class="text-start text-out"><i class="fa-solid fa-cart-shopping me-2"></i>Order Out</td>
                    <td class="text-muted-time">Oct 22, 10:15</td>
                    <td>Ciko</td>
                    <td>Kaca</td>
                    <td>800</td>
                    <td class="text-out">-48</td>
                    <td class="fw-bold-dark">752</td>
                </tr>
                <tr>
                    <td class="text-start text-out"><i class="fa-solid fa-cart-shopping me-2"></i>Order Out</td>
                    <td class="text-muted-time">Oct 24, 14:22</td>
                    <td>Bambang</td>
                    <td>Kardus</td>
                    <td>1,240</td>
                    <td class="text-out">-150</td>
                    <td class="fw-bold-dark">1,090</td>
                </tr>
                <tr>
                    <td class="text-start text-in"><i class="fa-solid fa-cart-shopping me-2"></i>Order In</td>
                    <td class="text-muted-time">Oct 24, 11:05</td>
                    <td>Sarah</td>
                    <td>Kain</td>
                    <td>740</td>
                    <td class="text-in">+500</td>
                    <td class="fw-bold-dark">1,240</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer-purple-bar">
        <div>Showing 1-14 of 14 records</div>
        <div class="pagination-custom">
            <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
            <a href="#" class="active-page">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
        </div>
    </div>
</div>
@endsection