@extends('layouts.app')

@section('title', 'Category Management - SIGMA')

@section('content')
<style>
    .content-body { padding: 30px 40px !important; background-color: #f4f5f9; }
    .page-title-center { text-align: center; font-size: 28px; font-weight: 800; color: #1e1b4b; margin-bottom: 40px; }
    .action-bar-category { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .search-box-category { position: relative; max-width: 280px; width: 100%; }
    .search-box-category i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; }
    .search-box-category .form-control { padding: 10px 15px 10px 42px; border: 1px solid #d1d5db; border-radius: 8px; }
    
    .table-wrapper-category { background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    .category-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .category-table thead th { background-color: #3f3d8f; color: #ffffff; font-weight: 700; text-transform: uppercase; padding: 18px 20px; }
    .category-table td { padding: 20px; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
    
    .icon-link-detail { color: #9ca3af !important; text-decoration: none; font-size: 16px; cursor: pointer; }
    .icon-link-detail:hover { color: #2563eb !important; }
    .footer-purple-bar { background-color: #2e2a85; color: #ffffff; padding: 15px 20px; display: flex; justify-content: space-between; }
</style>

<h2 class="page-title-center">Category Management</h2>

<div class="action-bar-category">
    <div class="search-box-category">
        <i class="fa-solid fa-search"></i>
        <input type="text" class="form-control" placeholder="Search">
    </div>
</div>

<div class="table-wrapper-category">
    <table class="category-table text-center align-middle">
        <thead>
            <tr>
                <th style="width: 70%;" class="text-start ps-5">Category Name</th>
                <th style="width: 30%;">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @php
                $dummy_categories = [
                    ['id' => '1', 'name' => 'Sparepart'],
                    ['id' => '2', 'name' => 'Bahan Nuklir'],
                    ['id' => '3', 'name' => 'Elektronik'],
                    ['id' => '4', 'name' => 'Persenjataan ABRI'],
                ];
            @endphp

            @foreach($dummy_categories as $cat)
            <tr>
                <td class="text-start ps-5 fw-bold" style="color: #111827;">{{ $cat['name'] }}</td>
                <td>
                    <a href="{{ url('/admin/category-detail') }}" class="icon-link-detail" title="Lihat Detail Kategori">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer-purple-bar">
        <div>Rows per page: 10</div>
    </div>
</div>
@endsection