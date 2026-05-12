@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('header_title', 'Dashboard')

@section('content')
<div class="container-fluid">
    
    <div class="row g-5 mb-5">
        <div class="col-md-4">
            <div class="card p-4 border-start border-primary border-5 shadow-sm border-0" style="border-radius: 15px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold mb-2" style="letter-spacing: 1px;">TOTAL ITEMS</div>
                        <h2 class="fw-bold m-0">100</h2>
                    </div>
                    <i class="far fa-clipboard text-primary fs-3"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 border-start border-danger border-5 shadow-sm border-0" style="border-radius: 15px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold mb-2" style="letter-spacing: 1px;">OUT OF STOCK</div>
                        <h2 class="fw-bold m-0 text-danger">3</h2>
                    </div>
                    <i class="far fa-times-circle text-danger fs-3"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 border-start border-warning border-5 shadow-sm border-0" style="border-radius: 15px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold mb-2" style="letter-spacing: 1px;">LOW STOCK</div>
                        <h2 class="fw-bold m-0" style="color: #8b5a2b;">12</h2>
                    </div>
                    <i class="fas fa-exclamation-triangle text-warning fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-5 mb-5">
        <div class="col-md-4">
            <div class="card text-white p-5 shadow-sm border-0 d-flex align-items-start justify-content-start" style="background-color: #38bdf8; border-radius: 18px; min-height: 180px;">
                <h4 class="fw-bold">Category Management</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white p-5 shadow-sm border-0 d-flex align-items-start justify-content-start" style="background-color: #22c55e; border-radius: 18px; min-height: 180px;">
                <h4 class="fw-bold">Staff Management</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white p-5 shadow-sm border-0 d-flex align-items-start justify-content-start" style="background-color: #ef4444; border-radius: 18px; min-height: 180px;">
                <h4 class="fw-bold">Activity Log</h4>
            </div>
        </div>
    </div>

    <div class="row g-5">
        
        <div class="col-md-6">
            <div class="card p-5 shadow-sm border-0 h-100" style="border-radius: 20px;">
                <h5 class="fw-bold mb-5" style="color: var(--sigma-purple); letter-spacing: 0.5px;">Activity Log Summary</h5>
                <div class="table-responsive">
                    <table class="table align-middle text-center mb-0">
                        <thead class="text-muted small" style="letter-spacing: 1px;">
                            <tr class="border-bottom">
                                <th class="text-start pb-4 border-0">NAMA BARANG</th>
                                <th class="pb-4 border-0">TANGGAL</th>
                                <th class="pb-4 border-0">JUMLAH TRANSAKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start fw-bold text-dark py-4 border-0">Kayu Jati</td>
                                <td class="text-muted py-4 border-0">xx/xx/xxxx</td>
                                <td class="fw-bold py-4 border-0 text-dark">452</td>
                            </tr>
                            <tr>
                                <td class="text-start fw-bold text-dark py-4 border-0">Kabel</td>
                                <td class="text-muted py-4 border-0">xx/xx/xxxx</td>
                                <td class="fw-bold py-4 border-0" style="color: #b45309;">8</td>
                            </tr>
                            <tr>
                                <td class="text-start fw-bold text-dark py-4 border-0">Kaca</td>
                                <td class="text-muted py-4 border-0">xx/xx/xxxx</td>
                                <td class="fw-bold text-danger py-4 border-0">0</td>
                            </tr>
                            <tr>
                                <td class="text-start fw-bold text-dark py-4 border-0 border-bottom">Cat</td>
                                <td class="text-muted py-4 border-0 border-bottom">xx/xx/xxxx</td>
                                <td class="fw-bold py-4 border-0 border-bottom text-dark">1,024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-5 shadow-sm border-0 h-100" style="border-radius: 20px;">
                <h5 class="fw-bold mb-5" style="color: var(--sigma-purple); letter-spacing: 0.5px;">Stock Status</h5>
                <div class="table-responsive">
                    <table class="table align-middle text-center mb-0">
                        <thead class="text-muted small" style="letter-spacing: 1px;">
                            <tr class="border-bottom">
                                <th class="text-start pb-4 border-0">NAMA BARANG</th>
                                <th class="pb-4 border-0">JUMLAH BARANG</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start fw-bold text-dark py-4 border-0">Kayu Jati</td>
                                <td class="text-muted py-4 border-0 text-dark">100</td>
                            </tr>
                            <tr>
                                <td class="text-start fw-bold text-dark py-4 border-0">Kabel</td>
                                <td class="text-muted py-4 border-0 text-dark">120</td>
                            </tr>
                            <tr>
                                <td class="text-start fw-bold text-dark py-4 border-0">Kaca</td>
                                <td class="text-muted py-4 border-0 text-dark">300</td>
                            </tr>
                            <tr>
                                <td class="text-start fw-bold text-dark py-4 border-0 border-bottom">Cat</td>
                                <td class="text-muted py-4 border-0 border-bottom text-dark">200</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection