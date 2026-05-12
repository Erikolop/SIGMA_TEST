@extends('layouts.app')

@section('title', 'Item Management')
@section('header_title', '') @section('content')
<div class="text-center mb-5 mt-2">
    <h2 class="fw-bold" style="color: var(--sigma-purple);">Item Management</h2>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="input-group" style="width: 300px;">
        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
        <input type="text" class="form-control border-start-0" placeholder="Search" style="box-shadow: none;">
    </div>
    <button class="btn text-white px-4 py-2" style="background-color: #0b1136; border-radius: 8px; font-weight: 500;">
        Catat Transaksi
    </button>
</div>

<div class="card overflow-hidden shadow-sm border-0" style="border-radius: 12px;">
    <table class="table table-hover mb-0 text-center align-middle">
        <thead style="background-color: var(--sigma-purple); color: white;">
            <tr>
                <th class="py-3 text-start ps-4">Nama Item</th>
                <th class="py-3">Category Item</th>
                <th class="py-3">Stock Item</th>
                <th class="py-3">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-start fw-bold ps-4 py-3">Oli Mesin</td>
                <td class="text-muted">Spare Part Leopard</td>
                <td>0</td>
                <td><button class="btn btn-sm text-secondary"><i class="fas fa-pen"></i></button></td>
            </tr>
            <tr>
                <td class="text-start fw-bold ps-4 py-3">Uranium-235</td>
                <td class="text-muted">Bahan Nuklir</td>
                <td>25</td>
                <td><button class="btn btn-sm text-secondary"><i class="fas fa-pen"></i></button></td>
            </tr>
            <tr>
                <td class="text-start fw-bold ps-4 py-3">Iphone 15</td>
                <td class="text-muted">Elektronik</td>
                <td>40</td>
                <td><button class="btn btn-sm text-secondary"><i class="fas fa-pen"></i></button></td>
            </tr>
            <tr>
                <td class="text-start fw-bold ps-4 py-3">Pelor 5.56mm</td>
                <td class="text-muted">Persenjataan ABRI</td>
                <td>60</td>
                <td><button class="btn btn-sm text-secondary"><i class="fas fa-pen"></i></button></td>
            </tr>
            <tr>
                <td class="text-start fw-bold ps-4 py-3">Router Starlink</td>
                <td class="text-muted">Elektronik</td>
                <td>30</td>
                <td><button class="btn btn-sm text-secondary"><i class="fas fa-pen"></i></button></td>
            </tr>
        </tbody>
    </table>
    
    <div class="p-2 d-flex justify-content-between align-items-center text-white" style="background-color: var(--sigma-purple);">
        <div class="ms-3 d-flex align-items-center gap-2">
            <span class="small opacity-75">Rows per page:</span>
            <select class="form-select form-select-sm bg-white text-dark border-0 shadow-none rounded-1" style="width: 50px; cursor: pointer;">
                <option>10</option>
            </select>
            <span class="small opacity-75 ms-2">1-10 of 140 rows</span>
        </div>
        <nav>
            <ul class="pagination pagination-sm mb-0 me-3">
                <li class="page-item disabled"><a class="page-link bg-transparent border-0 text-white" href="#">&lt;</a></li>
                <li class="page-item"><a class="page-link text-primary bg-white fw-bold rounded-1" href="#">1</a></li>
                <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#">2</a></li>
                <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#">3</a></li>
                <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#">...</a></li>
                <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#">14</a></li>
                <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#">&gt;</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection