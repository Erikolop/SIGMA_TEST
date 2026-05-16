@extends('layouts.app')

@section('title', 'Item Management - Admin')
@section('header_title', 'Item Management')

@section('content')
<div class="container-fluid">
    
    <div id="notifSukses" class="alert alert-success alert-dismissible fade show d-none mb-3 shadow-sm" role="alert" style="border-radius: 8px; font-size: 14px; max-width: 350px; background-color: #d1e7dd; border-color: #badbcc; color: #0f5132; font-weight: 600;">
        <i class="fa-solid fa-circle-check me-2"></i> Item berhasil ditambahkan
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
            <table class="table align-middle mb-0">
                <thead>
                    <tr class="text-muted small" style="border-bottom: 2px solid #f3f4f6; font-size: 12px; font-weight: 700; color: #111827;">
                        <th class="pb-3 border-0">NAMA ITEM</th>
                        <th class="pb-3 border-0">CATEGORY ITEM</th>
                        <th class="pb-3 border-0">STOCK ITEM</th>
                        <th class="pb-3 border-0 text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #f3f4f6; font-size: 14px;">
                        <td class="fw-bold text-dark py-3 border-0">Oli Mesin</td>
                        <td class="text-muted">Spare Part Leopard</td>
                        <td>0</td>
                        <td class="text-center border-0"><button class="btn btn-link text-dark p-0"><i class="fa-solid fa-pen"></i></button></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f3f4f6; font-size: 14px;">
                        <td class="fw-bold text-dark py-3 border-0">Uranium-235</td>
                        <td class="text-muted">Bahan Nuklir</td>
                        <td>25</td>
                        <td class="text-center border-0"><button class="btn btn-link text-dark p-0"><i class="fa-solid fa-pen"></i></button></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f3f4f6; font-size: 14px;">
                        <td class="fw-bold text-dark py-3 border-0">Iphone 15</td>
                        <td class="text-muted">Elektronik</td>
                        <td>40</td>
                        <td class="text-center border-0"><button class="btn btn-link text-dark p-0"><i class="fa-solid fa-pen"></i></button></td>
                    </tr>
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
    function prosesTambahBarang(event) {
        event.preventDefault(); // Mencegah halaman reload & error 404/500

        // Tutup modal popup secara programmatic
        var modalElemen = document.getElementById('adminTambahBarangModal');
        var modalInstance = bootstrap.Modal.getInstance(modalElemen);
        modalInstance.hide();

        // Tampilkan notifikasi hijau di atas kolom search
        var notif = document.getElementById('notifSukses');
        notif.classList.remove('d-none');

        // Reset isi form biar kosong lagi pas dibuka nanti
        document.getElementById('formTambahBarang').reset();
    }

    function tutupNotif() {
        var notif = document.getElementById('notifSukses');
        notif.classList.add('d-none');
    }
</script>
@endsection