@extends('layouts.app')

@section('title', 'Staff Dashboard')
@section('header_title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card p-4 border-start border-primary border-4 shadow-sm h-100" style="border-radius: 12px;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small fw-bold mb-1 tracking-wider">TOTAL ITEMS</div>
                    <h2 class="fw-bold m-0 text-dark">100</h2>
                </div>
                <i class="far fa-clipboard text-primary fs-4"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 border-start border-warning border-4 shadow-sm h-100" style="border-radius: 12px;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small fw-bold mb-1 tracking-wider">LOW STOCK</div>
                    <h2 class="fw-bold m-0" style="color: #8b5a2b;">12</h2>
                </div>
                <i class="fas fa-exclamation-triangle text-warning fs-4"></i>
            </div>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-4">
        <div class="card p-4 shadow-sm border-0 d-flex flex-column justify-content-center" style="background-color: #f59e0b; color: white; border-radius: 12px; height: 160px;">
            <h4 class="fw-bold mb-4">Item Management</h4>
            <button class="btn btn-sm fw-bold w-75 text-start px-3" style="background-color: rgba(255,255,255,0.2); color: white; border: none; border-radius: 20px;">
                MANAGE YOUR ITEM
            </button>
        </div>
    </div>
</div>

<div class="card p-4 shadow-sm border-0" style="border-radius: 12px;">
    <h5 class="fw-bold mb-4" style="color: var(--sigma-purple);">Current Stock Status</h5>
    <div class="table-responsive">
        <table class="table align-middle text-center mb-0">
            <thead class="text-muted" style="font-size: 11px; letter-spacing: 1px;">
                <tr>
                    <th class="text-start pb-3 border-bottom-0">ITEM ID</th>
                    <th class="pb-3 border-bottom-0">NAME</th>
                    <th class="pb-3 border-bottom-0">CATEGORY</th>
                    <th class="pb-3 border-bottom-0">STOCK BARANG</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-start text-muted small py-3 border-0">item_223</td>
                    <td class="fw-bold text-dark py-3 border-0">Kayu Jati</td>
                    <td class="text-muted small py-3 border-0">Furniture</td>
                    <td class="fw-bold text-dark py-3 border-0">452</td>
                </tr>
                <tr>
                    <td class="text-start text-muted small py-3 border-0">item_226</td>
                    <td class="fw-bold text-dark py-3 border-0">Kabel</td>
                    <td class="text-muted small py-3 border-0">Elektronik</td>
                    <td class="fw-bold py-3 border-0" style="color: #8b5a2b;">2000</td>
                </tr>
                <tr>
                    <td class="text-start text-muted small py-3 border-0">item_220</td>
                    <td class="fw-bold text-dark py-3 border-0">Kaca</td>
                    <td class="text-muted small py-3 border-0">Optik</td>
                    <td class="fw-bold text-danger py-3 border-0">0</td>
                </tr>
                <tr>
                    <td class="text-start text-muted small py-3 border-0 border-bottom">item_229</td>
                    <td class="fw-bold text-dark py-3 border-0 border-bottom">Cat</td>
                    <td class="text-muted small py-3 border-0 border-bottom">Material</td>
                    <td class="fw-bold text-dark py-3 border-0 border-bottom">1,024</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection