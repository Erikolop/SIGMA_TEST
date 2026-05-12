@extends('layouts.app')

@section('title', 'Activity Log')

@section('content')
<div class="d-flex border-bottom mb-4">
    <div class="pb-2 border-bottom border-warning border-3 text-warning fw-bold px-3">Activity Log</div>
</div>

<div class="d-flex gap-2 align-items-center mb-4">
    <div class="input-group" style="width: 300px;">
        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
        <input type="text" class="form-control border-start-0" placeholder="Search" style="box-shadow: none;">
    </div>
    <button class="btn btn-light border text-dark px-3"><i class="fas fa-calendar-alt fs-5"></i></button>
</div>

<div class="card overflow-hidden shadow-sm border-0" style="border-radius: 12px;">
    <table class="table mb-0 text-center align-middle" style="font-size: 14px;">
        <thead class="bg-light text-muted small">
            <tr>
                <th class="py-3 text-start ps-4">SOURCE</th>
                <th>TIME</th>
                <th>NAME</th>
                <th>ITEM</th>
                <th>INITIAL</th>
                <th>ADJUSTMENT</th>
                <th>REMAINING</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-start ps-4"><i class="fas fa-shopping-cart text-danger me-2"></i> Order Out</td>
                <td class="text-muted">Oct 24, 14:22</td>
                <td>Bambang</td>
                <td>Kardus</td>
                <td>1,240</td>
                <td class="text-danger fw-bold">-150</td>
                <td class="fw-bold">1,090</td>
            </tr>
            <tr>
                <td class="text-start ps-4"><i class="fas fa-shopping-cart text-success me-2"></i> Order In</td>
                <td class="text-muted">Oct 24, 11:05</td>
                <td>Sarah</td>
                <td>Kain</td>
                <td>740</td>
                <td class="text-success fw-bold">+500</td>
                <td class="fw-bold">1,240</td>
            </tr>
            <tr>
                <td class="text-start ps-4"><i class="fas fa-shopping-cart text-danger me-2"></i> Order Out</td>
                <td class="text-muted">Oct 22, 18:30</td>
                <td>Daffa</td>
                <td>Semen</td>
                <td>752</td>
                <td class="text-danger fw-bold">-40</td>
                <td class="fw-bold">712</td>
            </tr>
        </tbody>
    </table>
    
    <div class="p-2 d-flex justify-content-between align-items-center text-white" style="background-color: var(--sigma-purple);">
        <small class="ms-3">Showing 1-14 of 14 records</small>
        <nav>
            <ul class="pagination pagination-sm mb-0 me-3">
                <li class="page-item disabled"><a class="page-link bg-transparent border-0 text-white" href="#">&lt;</a></li>
                <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>
                <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#">2</a></li>
                <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#">3</a></li>
                <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#">&gt;</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection