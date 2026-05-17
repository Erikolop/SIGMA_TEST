@extends('layouts.app')

@section('title', 'Item Management - Staff')
@section('header_title', 'Item Management')

@section('content')
<div class="container-fluid">
    
    <div id="notifSuksesStaff" class="alert alert-success alert-dismissible fade show d-none mb-3 shadow-sm" role="alert" style="border-radius: 8px; font-size: 14px; max-width: 350px; background-color: #d1e7dd; border-color: #badbcc; color: #0f5132; font-weight: 600;">
        <i class="fa-solid fa-circle-check me-2"></i> <span id="textNotifStaff">Item berhasil ditambahkan</span>
        <button type="button" class="btn-close" style="padding: 1rem 1rem; font-size: 10px;" onclick="tutupNotifStaff()"></button>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="position-relative">
            <input type="text" class="search-input" placeholder="Search" style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px 16px; font-size: 14px; width: 280px;">
        </div>
        <button type="button" class="btn btn-catat shadow-sm" data-bs-toggle="modal" data-bs-target="#formInventarisModal">
            Catat Transaksi
        </button>
    </div>

    <div class="table-container shadow-sm border-0 bg-white p-4" style="border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        <div class="table-responsive">
            <table class="table custom-table mb-0 align-middle text-center" style="table-layout: fixed; width: 100%;">
                <thead>
                    <tr>
                        <th class="text-start ps-3" style="width: 30%">Nama Item</th>
                        <th style="width: 30%">Category Item</th>
                        <th style="width: 20%">Stock Item</th>
                        <th style="width: 20%" class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $items = [
                            ['name' => 'Oli Mesin', 'category' => 'Spare Part Leopard', 'stock' => 0],
                            ['name' => 'Uranium-235', 'category' => 'Bahan Nuklir', 'stock' => 25],
                            ['name' => 'Iphone 15', 'category' => 'Elektronik', 'stock' => 40],
                            ['name' => 'Pelor 5.56mm', 'category' => 'Persenjataan ABRI', 'stock' => 60],
                            ['name' => 'Router Starlink', 'category' => 'Elektronik', 'stock' => 30],
                        ];
                    @endphp

                    @foreach($items as $index => $item)
                    <tr id="row-{{ $index }}" style="height: 75px; border-bottom: 1px solid #f3f4f6;">
                        <td class="text-start ps-3">
                            <span class="fw-bold text-dark text-view">{{ $item['name'] }}</span>
                            <div class="text-edit d-none" style="max-width: 200px;">
                                <input type="text" id="input-name-{{ $index }}" class="form-control form-control-sm shadow-sm" value="{{ $item['name'] }}" style="font-size: 14px; border-radius: 6px;">
                            </div>
                        </td>

                        <td>
                            <span class="text-muted text-view">{{ $item['category'] }}</span>
                            <div class="text-edit d-none mx-auto" style="max-width: 200px;">
                                <input type="text" id="input-cat-{{ $index }}" class="form-control form-control-sm shadow-sm text-center" value="{{ $item['category'] }}" style="font-size: 14px; border-radius: 6px;">
                            </div>
                        </td>

                        <td>
                            <span class="text-dark fw-semibold text-view-stock">{{ $item['stock'] }}</span>
                        </td>

                        <td class="text-center">
                            <div class="action-view">
                                <button class="btn btn-link text-dark p-0 border-0 bg-transparent" onclick="bukaModeEdit({{ $index }})">
                                    <i class="fa-solid fa-pen fs-5"></i>
                                </button>
                            </div>

                            <div class="action-edit d-none align-items-center justify-content-center" style="gap: 15px; height: 38px;">
                                <div style="width: 90px;">
                                    <input type="number" id="input-stock-{{ $index }}" class="form-control text-center fw-bold form-control-sm shadow-sm" value="{{ $item['stock'] }}" min="0" style="border: 1px solid #999999; border-radius: 8px; height: 38px; font-size: 15px;">
                                </div>
                                <button class="btn p-0 border-0 bg-transparent text-success d-flex align-items-center" onclick="simpanModeEdit({{ $index }})">
                                    <i class="fas fa-check-circle fs-3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="formInventarisModal" tabindex="-1" aria-labelledby="formInventarisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="text-center mb-4 position-relative">
                <h4 class="modal-title-custom m-0" id="formInventarisModalLabel">Formulir Inventaris Produk</h4>
                <span class="modal-subtitle-custom">SIGMA</span>
                <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formTambahBarangStaff" onsubmit="prosesTambahStaff(event)">
                <div class="mb-4">
                    <label class="form-label form-label-custom">Nama Produk</label>
                    <input type="text" class="form-control form-control-custom w-100" required placeholder="Contoh: Meja Kerja Kayu Jati">
                </div>

                <div class="mb-4">
                    <label class="form-label form-label-custom">Jumlah Unit</label>
                    <input type="number" class="form-control form-control-custom w-100" required placeholder="0" min="1">
                </div>

                <div class="mb-4">
                    <label class="form-label form-label-custom">Tipe Kelola</label>
                    <input type="text" class="form-control form-control-custom w-100" required placeholder="Contoh: Keluar atau Masuk">
                </div>

                <div class="text-center mb-4">
                    <button type="button" class="btn-tambah-link">+ Tambah Produk Lainnya</button>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn-kirim shadow-sm">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function bukaModeEdit(index) {
        var row = document.getElementById('row-' + index);
        
        row.querySelectorAll('.text-view').forEach(el => el.classList.add('d-none'));
        row.querySelectorAll('.text-edit').forEach(el => el.classList.remove('d-none'));
        
        row.querySelector('.text-view-stock').classList.add('d-none');
        row.querySelector('.action-view').classList.add('d-none');
        
        var editAction = row.querySelector('.action-edit');
        editAction.classList.remove('d-none');
        editAction.classList.add('d-flex');
    }

    function simpanModeEdit(index) {
        var row = document.getElementById('row-' + index);
        
        var newName = document.getElementById('input-name-' + index).value;
        var newCat = document.getElementById('input-cat-' + index).value;
        var newStock = document.getElementById('input-stock-' + index).value;
        
        row.querySelectorAll('.text-view')[0].innerText = newName;
        row.querySelectorAll('.text-view')[1].innerText = newCat;
        row.querySelector('.text-view-stock').innerText = newStock;
        
        row.querySelectorAll('.text-view').forEach(el => el.classList.remove('d-none'));
        row.querySelectorAll('.text-edit').forEach(el => el.classList.add('d-none'));
        row.querySelector('.text-view-stock').classList.remove('d-none');
        
        row.querySelector('.action-view').classList.remove('d-none');
        var editAction = row.querySelector('.action-edit');
        editAction.classList.add('d-none');
        editAction.classList.remove('d-flex');
        
        document.getElementById('textNotifStaff').innerText = "Item berhasil diubah";
        var notif = document.getElementById('notifSuksesStaff');
        notif.classList.remove('d-none');
        
        setTimeout(function() {
            tutupNotifStaff();
        }, 4000);
    }

    function prosesTambahStaff(event) {
        event.preventDefault(); 
        var modalElemen = document.getElementById('formInventarisModal');
        var modalInstance = bootstrap.Modal.getInstance(modalElemen);
        modalInstance.hide();

        document.getElementById('textNotifStaff').innerText = "Item berhasil ditambahkan";
        var notif = document.getElementById('notifSuksesStaff');
        notif.classList.remove('d-none');

        document.getElementById('formTambahBarangStaff').reset();
        
        setTimeout(function() {
            tutupNotifStaff();
        }, 4000);
    }

    function tutupNotifStaff() {
        var notif = document.getElementById('notifSuksesStaff');
        if(notif) {
            notif.classList.add('d-none');
        }
    }
</script>
@endsection