@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('header_title', 'Dashboard')

@section('content')
<div class="container-fluid">
    
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card p-4 border-start border-primary border-5 shadow-sm border-0 bg-white" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold mb-2" style="letter-spacing: 0.5px; font-size: 11px;">TOTAL ITEMS</div>
                        <h2 class="fw-bold m-0 text-dark" style="font-size: 32px;">{{ $totalItems }}</h2>
                    </div>
                    <i class="far fa-clipboard text-primary fs-3"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card p-4 border-start border-danger border-5 shadow-sm border-0 bg-white" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold mb-2" style="letter-spacing: 0.5px; font-size: 11px;">OUT OF STOCK</div>
                        <h2 class="fw-bold m-0 text-danger" style="font-size: 32px;">{{ $outOfStock }}</h2>
                    </div>
                    <i class="far fa-times-circle text-danger fs-3"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card p-4 border-start border-warning border-5 shadow-sm border-0 bg-white" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold mb-2" style="letter-spacing: 0.5px; font-size: 11px;">LOW STOCK</div>
                        <h2 class="fw-bold m-0" style="color: #b45309; font-size: 32px;">{{ $lowStock }}</h2>
                    </div>
                    <i class="fas fa-exclamation-triangle text-warning fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <a href="/admin/category-management" class="text-decoration-none">
                <div class="card text-white p-4 shadow-sm border-0 d-flex align-items-start justify-content-between position-relative overflow-hidden group-menu-card" style="background: linear-gradient(135deg, #38bdf8, #0284c7); border-radius: 16px; min-height: 140px; transition: transform 0.2s ease;">
                    <h4 class="fw-bold m-0" style="font-size: 20px; z-index: 2;">Category Management</h4>
                    <i class="fa-solid fa-layer-group position-absolute" style="font-size: 80px; bottom: -10px; right: -10px; color: rgba(255,255,255,0.15);"></i>
                </div>
            </a>
        </div>
        
        <div class="col-md-4">
            <a href="/admin/staff-management" class="text-decoration-none">
                <div class="card text-white p-4 shadow-sm border-0 d-flex align-items-start justify-content-between position-relative overflow-hidden group-menu-card" style="background: linear-gradient(135deg, #22c55e, #16a34a); border-radius: 16px; min-height: 140px; transition: transform 0.2s ease;">
                    <h4 class="fw-bold m-0" style="font-size: 20px; z-index: 2;">Staff Management</h4>
                    <i class="fa-solid fa-users position-absolute" style="font-size: 80px; bottom: -10px; right: -10px; color: rgba(255,255,255,0.15);"></i>
                </div>
            </a>
        </div>
        
        <div class="col-md-4">
            <a href="/admin/activity-log" class="text-decoration-none">
                <div class="card text-white p-4 shadow-sm border-0 d-flex align-items-start justify-content-between position-relative overflow-hidden group-menu-card" style="background: linear-gradient(135deg, #ef4444, #dc2626); border-radius: 16px; min-height: 140px; transition: transform 0.2s ease;">
                    <h4 class="fw-bold m-0" style="font-size: 20px; z-index: 2;">Activity Log</h4>
                    <i class="fa-solid fa-chart-line position-absolute" style="font-size: 80px; bottom: -10px; right: -10px; color: rgba(255,255,255,0.15);"></i>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-md-6">
            <div class="card p-4 shadow-sm border-0 bg-white" style="border-radius: 16px; height: 100%;">
                <h5 class="fw-bold mb-4 text-dark" style="letter-spacing: 0.5px; color: #1e1b4b !important;">Activity Log Summary</h5>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-muted small" style="letter-spacing: 0.5px; font-size: 11px; border-bottom: 2px solid #f3f4f6;">
                                <th class="text-start pb-3 border-0">NAMA BARANG</th>
                                <th class="text-center pb-3 border-0">TANGGAL</th>
                                <th class="text-center pb-3 border-0">JUMLAH TRANSAKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentLogs as $log)
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td class="text-start fw-bold text-dark py-3 border-0">{{ $log->nama_item }}</td>
                                <td class="text-center text-muted py-3 border-0">{{ $log->tgl_transaksi ? $log->tgl_transaksi->format('d/m/Y') : '-' }}</td>
                                <td class="text-center fw-bold py-3 border-0 text-dark">{{ $log->perubahan_qty }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3 border-0">Belum ada aktivitas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4 shadow-sm border-0 bg-white" style="border-radius: 16px; height: 100%;">
                <h5 class="fw-bold mb-4 text-dark" style="letter-spacing: 0.5px; color: #1e1b4b !important;">Stock Status</h5>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-muted small" style="letter-spacing: 0.5px; font-size: 11px; border-bottom: 2px solid #f3f4f6;">
                                <th class="text-start pb-3 border-0">NAMA BARANG</th>
                                <th class="text-center pb-3 border-0">JUMLAH BARANG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lowestStockItems as $item)
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td class="text-start fw-bold text-dark py-3 border-0">{{ $item->item_name }}</td>
                                <td class="text-center fw-bold py-3 border-0 {{ $item->item_qty == 0 ? 'text-danger' : ($item->item_qty < 20 ? 'text-warning' : 'text-dark') }}">{{ $item->item_qty }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted py-3 border-0">Belum ada data barang</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .group-menu-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
    }
</style>
@endsection