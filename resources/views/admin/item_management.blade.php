@extends('layouts.app')

@section('title', 'Item Management - Admin')
@section('header_title', 'Item Management')

@section('content')
<div class="container-fluid">
    
    <div id="notifSukses" class="alert alert-success alert-dismissible fade show d-none mb-3 shadow-sm" role="alert" style="border-radius: 8px; font-size: 14px; max-width: 350px; background-color: #d1e7dd; border-color: #badbcc; color: #0f5132; font-weight: 600;">
        <i class="fa-solid fa-circle-check me-2"></i> <span id="textNotif">Item berhasil ditambahkan</span>
        <button type="button" class="btn-close" style="padding: 1rem 1rem; font-size: 10px;" onclick="tutupNotif()"></button>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="position-relative">
            <input type="text" class="form-control" placeholder="Search" style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px 16px; font-size: 14px; width: 280px;">
        </div>
        <button type="button" class="btn text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#adminTambahBarangModal" style="background-color: #0b093b; border-radius: 8px; padding: 10px 24px; font-weight: 700; font-size: 14px; border: none; transition: background 0.2s;">
            Catat Transaksi
        </button>
    </div>

    <div class="card p-4 shadow-sm border-0 bg-white" style="border-radius: 16px;">
        <div class="table-responsive">
            <table class="table align-middle mb-0 text-center" style="table-layout: fixed; width: 100%;">
                <thead>
                    <tr class="text-muted small" style="border-bottom: 2px solid #f3f4f6; font-size: 12px; font-weight: 700; color: #111827;">
                        <th class="pb-3 border-0 text-start ps-3" style="width: 30%;">NAMA ITEM</th>
                        <th class="pb-3 border-0" style="width: 30%;">CATEGORY ITEM</th>
                        <th class="pb-3 border-0" style="width: 20%;">STOCK ITEM</th>
                        <th class="pb-3 border-0 text-center" style="width: 20%;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $items = [
                            ['name' => 'Oli Mesin', 'category' => 'Spare Part Leopard', 'stock' => 0],
                            ['name' => 'Uranium-235', 'category' => 'Bahan Nuklir', 'stock' => 25],
                            ['name' => 'Iphone 15', 'category' => 'Elektronik', 'stock' => 40],
                        ];
                    @endphp

                    @foreach($items as $index => $item)
                    <tr id="row-{{ $index }}" style="border-bottom: 1px solid #f3f4f6; font-size: 14px; height: 75px;">
                        <td class="text-start ps-3 py-3 border-0">
                            <span class="fw-bold text-dark text-view">{{ $item['name'] }}</span>
                            <div class="text-edit d-none" style="max-width: 200px;">
                                <input type="text" id="input-name-{{ $index }}" class="form-control form-control-sm shadow-sm" value="{{ $item['name'] }}" style="font-size: 14px; border-radius: 6px;">
                            </div>
                        </td>

                        <td class="border-0">
                            <span class="text-muted text-view">{{ $item['category'] }}</span>
                            <div class="text-edit d-none mx-auto" style="max-width: 200px;">
                                <input type="text" id="input-cat-{{ $index }}" class="form-control form-control-sm shadow-sm text-center" value="{{ $item['category'] }}" style="font-size: 14px; border-radius: 6px;">
                            </div>
                        </td>

                        <td class="border-0">
                            <span class="text-dark fw-semibold text-view-stock">{{ $item['stock'] }}</span>
                        </td>

                        <td class="border-0 text-center">
                            <div class="action-view">
                                <button class="btn btn-link text-dark p-0 border-0 bg-transparent me-2" onclick="bukaModeEdit({{ $index }})">
                                    <i class="fa-solid fa-pen fs-5"></i>
                                </button>
                            </div>

                            <div class="action-edit d-none align-items-center justify-content-center" style="gap: 12px; height: 38px;">
                                <button class="btn p-0 border-0 bg-transparent text-danger" onclick="hapusBaris({{ $index }})">
                                    <i class="fas fa-trash-alt fs-5"></i>
                                </button>
                                
                                <div style="width: 85px;">
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

<div class="modal fade" id="adminTambahBarangModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4" style="border-radius: 20px; border: none;">
            <div class="text-center mb-4 position-relative">
                <h4 class="m-0 fw-bold" id="adminModalLabel" style="color: #3b82f6; letter-spacing: 0.5px; font-size: 24px; text-transform: uppercase;">Formulir Inventaris Produk</h4>
                <span style="color: #9ca3af; font-size: 12px; font-style: italic; margin-top: -5px; display: block;">SIGMA (ADMIN MODE)</span>
                <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formTambahBarang" onsubmit="prosesTambahBarang(event)">
                <div class="mb-4">
                    <label class="form-label" style="font-size: 11px; font-weight: 700; color: #6b7280; letter-spacing: 0.5px; text-transform: uppercase;">Nama Produk</label>
                    <input type="text" class="form-control" required placeholder="Contoh: Meja Kerja Kayu Jati" style="border: 2px solid #d1d5db; border-radius: 8px; padding: 12px 16px; font-size: 14px;">
                </div>

                <div class="mb-4">
                    <label class="form-label" style="font-size: 11px; font-weight: 700; color: #6b7280; letter-spacing: 0.5px; text-transform: uppercase;">Jumlah Unit</label>
                    <input type="number" class="form-control" required placeholder="0" min="1" style="border: 2px solid #d1d5db; border-radius: 8px; padding: 12px 16px; font-size: 14px;">
                </div>

                <div class="mb-4">
                    <label class="form-label" style="font-size: 11px; font-weight: 700; color: #6b7280; letter-spacing: 0.5px; text-transform: uppercase;">Tipe Kelola</label>
                    <input type="text" class="form-control" required placeholder="Contoh: Keluar atau Masuk" style="border: 2px solid #d1d5db; border-radius: 8px; padding: 12px 16px; font-size: 14px;">
                </div>

                <div class="text-center mb-4">
                    <button type="button" class="btn btn-link p-0 text-decoration-underline" style="color: #3b82f6; font-weight: 600; font-size: 14px; border: none; background: none;">+ Tambah Produk Lainnya</button>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn text-white fw-bold text-uppercase" style="background-color: #2563eb; border-radius: 8px; padding: 14px; width: 160px; font-size: 14px; border: none; letter-spacing: 0.5px;">Kirim</button>
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
        
        row.querySelector('.text-view-stock').classList.add('d-none'); // Sembunyikan text stock lama
        row.querySelector('.action-view').classList.add('d-none');
        
        var editAction = row.querySelector('.action-edit');
        editAction.classList.remove('d-none');
        editAction.classList.add('d-flex');
    }

    function simpanModeEdit(index) {
        var row = document.getElementById('row-' + index);
        
        // Ambil value ketikan baru dari input text & number spinner
        var newName = document.getElementById('input-name-' + index).value;
        var newCat = document.getElementById('input-cat-' + index).value;
        var newStock = document.getElementById('input-stock-' + index).value;
        
        // Tembak teks baru ke penampung visual view
        row.querySelectorAll('.text-view')[0].innerText = newName;
        row.querySelectorAll('.text-view')[1].innerText = newCat;
        row.querySelector('.text-view-stock').innerText = newStock;
        
        // Kembalikan ke mode view normal
        row.querySelectorAll('.text-view').forEach(el => el.classList.remove('d-none'));
        row.querySelectorAll('.text-edit').forEach(el => el.classList.add('d-none'));
        row.querySelector('.text-view-stock').classList.remove('d-none');
        
        row.querySelector('.action-view').classList.remove('d-none');
        var editAction = row.querySelector('.action-edit');
        editAction.classList.add('d-none');
        editAction.classList.remove('d-flex');
        
        // TAMPILKAN NOTIFIKASI HIJAU DI ATAS
        document.getElementById('textNotif').innerText = "Item berhasil diubah";
        var notif = document.getElementById('notifSukses');
        notif.classList.remove('d-none');
        
        // Menutup alert otomatis dalam 4 detik
        setTimeout(function() {
            tutupNotif();
        }, 4000);
    }

    function prosesTambahBarang(event) {
        event.preventDefault();
        var modalElemen = document.getElementById('adminTambahBarangModal');
        var modalInstance = bootstrap.Modal.getInstance(modalElemen);
        modalInstance.hide();

        document.getElementById('textNotif').innerText = "Item berhasil ditambahkan";
        var notif = document.getElementById('notifSukses');
        notif.classList.remove('d-none');

        document.getElementById('formTambahBarang').reset();
        
        setTimeout(function() {
            tutupNotif();
        }, 4000);
    }

    function hapusBaris(index) {
        if(confirm("Hapus item produk ini dari database SIGMA?")) {
            document.getElementById('row-' + index).remove();
        }
    }

    function tutupNotif() {
        var notif = document.getElementById('notifSukses');
        if(notif) {
            notif.classList.add('d-none');
        }
    }
</script>
@endsection