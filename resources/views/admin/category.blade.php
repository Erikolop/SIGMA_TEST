@extends('layouts.app')

@section('title', 'Category Management')

@section('content')
<div class="text-center mb-5">
    <h2 class="fw-bold" style="color: var(--sigma-purple);">Category Management</h2>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="search-box">
        <div class="input-group" style="width: 300px;">
            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
            <input type="text" class="form-control border-start-0" placeholder="Search" style="box-shadow: none;">
        </div>
    </div>
    <button class="btn text-white px-4" style="background-color: var(--sigma-purple); border-radius: 8px;">
        <i class="fas fa-plus-circle me-1"></i> Add Category
    </button>
</div>

<div class="card overflow-hidden shadow-sm border-0" style="border-radius: 12px;">
    <table class="table table-hover mb-0 text-center align-middle">
        <thead style="background-color: var(--sigma-purple); color: white;">
            <tr>
                <th class="py-3">ID</th>
                <th class="py-3">Category Name</th>
                <th class="py-3">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @php
                $categories = [
                    ['id' => 'category_01', 'name' => 'Logam'],
                    ['id' => 'category_02', 'name' => 'Elektronik'],
                    ['id' => 'category_03', 'name' => 'Bahan Nuklir'],
                    ['id' => 'category_04', 'name' => 'Persenjataan ABRI'],
                    ['id' => 'category_05', 'name' => 'Spare Part Leopard'],
                ];
            @endphp
            
            @foreach($categories as $cat)
            <tr>
                <td class="fw-bold py-3">{{ $cat['id'] }}</td>
                <td class="text-muted">{{ $cat['name'] }}</td>
                <td>
                    <button class="btn btn-sm text-secondary me-2"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-sm text-danger"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="d-flex justify-content-between align-items-center p-3 bg-white border-top">
        <div class="text-muted small"></div>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">&lt;</a></li>
                <li class="page-item active"><a class="page-link" href="#" style="background-color: var(--sigma-purple); border-color: var(--sigma-purple);">1</a></li>
                <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                <li class="page-item"><a class="page-link text-dark" href="#">...</a></li>
                <li class="page-item"><a class="page-link text-dark" href="#">14</a></li>
                <li class="page-item"><a class="page-link text-dark" href="#">&gt;</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection