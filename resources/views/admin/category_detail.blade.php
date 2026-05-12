@extends('layouts.app')

@section('title', 'Detail Category')

@section('content')
<div class="position-relative mb-5">
    <a href="/category-management" class="btn btn-light text-primary position-absolute top-0 start-0 border shadow-sm rounded-pill px-3 py-1" style="font-size: 14px;">
        <i class="fas fa-sign-out-alt fa-flip-horizontal me-1"></i> Return to Category
    </a>
    
    <div class="text-center">
        <h2 class="fw-bold mb-0" style="color: var(--sigma-purple);">Detail Category</h2>
        <h3 class="fw-normal text-dark">"Elektronik"</h3>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="input-group" style="width: 300px;">
        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
        <input type="text" class="form-control border-start-0" placeholder="Search" style="box-shadow: none;">
    </div>
    <button class="btn text-white px-4" style="background-color: var(--sigma-purple); border-radius: 8px;">
        Add Item
    </button>
</div>

<div class="card overflow-hidden shadow-sm border-0" style="border-radius: 12px;">
    <table class="table table-hover mb-0 text-center align-middle">
        <thead style="background-color: var(--sigma-purple); color: white;">
            <tr>
                <th class="py-3">Nama Item</th>
                <th class="py-3">Stock Item</th>
                <th class="py-3">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = [
                    ['name' => 'Spark Plug', 'stock' => 300],
                    ['name' => 'Charger Laptop', 'stock' => 2598],
                    ['name' => 'Iphone 15', 'stock' => 87],
                    ['name' => 'Air Conditioner Porsche', 'stock' => 23],
                    ['name' => 'Router Starlink', 'stock' => 44],
                ];
            @endphp
            
            @foreach($items as $item)
            <tr>
                <td class="fw-bold text-dark py-3">{{ $item['name'] }}</td>
                <td class="text-muted">{{ $item['stock'] }}</td>
                <td>
                    <button class="btn btn-sm text-secondary"><i class="fas fa-pen"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection