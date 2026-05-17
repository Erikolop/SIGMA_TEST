@extends('layouts.app')

@section('title', 'Category Management')

@section('content')
<div class="container-fluid" style="padding: 0 20px;">
    
    <div class="text-center mb-5">
        <h1 class="fw-bold" style="color: #0b093b; font-size: 36px; letter-spacing: -0.5px;">Category Management</h1>
    </div>

    <div id="notifSuksesCategory" class="alert alert-success alert-dismissible fade show d-none mb-4 shadow-sm" role="alert" style="border-radius: 8px; font-size: 14px; max-width: 350px; background-color: #d1e7dd; border-color: #badbcc; color: #0f5132; font-weight: 600;">
        <i class="fa-solid fa-circle-check me-2"></i> <span id="textNotifCategory">Kategori berhasil diubah</span>
        <button type="button" class="btn-close" style="padding: 1rem 1rem; font-size: 10px;" onclick="tutupNotif()"></button>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="position-relative">
            <span class="position-absolute top-50 start-0 translate-middle-y ps-3">
                <i class="fas fa-search text-muted" style="font-size: 14px;"></i>
            </span>
            <input type="text" class="form-control ps-5" placeholder="Search" style="background: #ffffff; border: 1px solid #d1d5db; border-radius: 8px; padding: 10px 16px; font-size: 14px; width: 320px; box-shadow: none;">
        </div>
        
        <button class="btn text-white px-4 d-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#adminTambahCategoryModal" style="background-color: #0b093b; border-radius: 8px; padding: 10px 20px; font-weight: 600; font-size: 14px; border: none; transition: background 0.2s;">
            <i class="fas fa-plus-circle" style="font-size: 13px;"></i> Add Category
        </button>
    </div>

    <div class="card shadow-sm border-0 overflow-hidden" style="border-radius: 8px;">
        <div class="table-responsive">
            <table class="table mb-0 text-center align-middle" style="table-layout: fixed; width: 100%; border-collapse: collapse;">
                <thead style="background-color: #3f3d8f; color: white;">
                    <tr style="height: 55px; font-size: 13px; font-weight: 600; letter-spacing: 0.5px;">
                        <th style="width: 30%; border: none;">ID</th>
                        <th style="width: 40%; border: none;">Category Name</th>
                        <th style="width: 30%; border: none;">ACTIONS</th>
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
                    
                    @foreach($categories as $index => $cat)
                    <tr id="row-{{ $index }}" style="border-bottom: 1px solid #e5e7eb; height: 75px; background-color: #ffffff;">
                        <td class="fw-bold text-dark" style="font-size: 14px;">{{ $cat['id'] }}</td>
                        
                        <td style="font-size: 14px;">
                            <span class="text-muted text-view">{{ $cat['name'] }}</span>
                            <div class="text-edit d-none mx-auto" style="max-width: 240px;">
                                <input type="text" id="input-{{ $index }}" class="form-control text-center form-control-sm shadow-sm" value="{{ $cat['name'] }}" style="font-size: 14px; border-radius: 6px; border: 1px solid #cccc;">
                            </div>
                        </td>
                        
                        <td>
                            <div class="action-view">
                                <button class="btn btn-sm text-secondary me-3 p-0 border-0 bg-transparent" style="color: #6b7280 !important;" onclick="bukaModeEdit({{ $index }})">
                                    <i class="fas fa-pen fs-5"></i>
                                </button>
                                <button class="btn btn-sm text-danger p-0 border-0 bg-transparent" style="color: #dc2626 !important;" onclick="hapusBaris({{ $index }})">
                                    <i class="fas fa-trash fs-5"></i>
                                </button>
                            </div>

                            <div class="action-edit d-none align-items-center justify-content-center" style="gap: 15px; height: 38px;">
                                <button class="btn p-0 border-0 bg-transparent text-danger" onclick="hapusBaris({{ $index }})">
                                    <i class="fas fa-trash-alt fs-4"></i>
                                </button>
                                <div style="width: 95px;">
                                    <input type="number" class="form-control text-center fw-bold form-control-sm shadow-sm" value="2" min="0" style="border: 1px solid #999999; border-radius: 8px; height: 38px; font-size: 16px;">
                                </div>
                                <button class="btn p-0 border-0 bg-transparent text-success d-flex align-items-center" onclick="simpanModeEdit({{ $index }})">
                                    <i class="fas fa-check-circle fs-2"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-3 d-flex justify-content-between align-items-center text-white" style="background-color: #3f3d8f;">
            <div style="font-size: 13px; color: rgba(255,255,255,0.8);">Showing 1-5 of 14 records</div>
            <nav>
                <ul class="pagination pagination-sm mb-0 align-items-center" style="gap: 4px;">
                    <li class="page-item disabled"><a class="page-link bg-transparent border-0 text-white-50" href="#" style="font-size: 14px; padding: 4px 8px;">&lt;</a></li>
                    <li class="page-item"><a class="page-link fw-bold border-0 text-white shadow-sm" href="#" style="border-radius: 4px; padding: 4px 10px; background-color: #2563eb; font-size: 13px;">1</a></li>
                    <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#" style="font-size: 13px; padding: 4px 10px;">2</a></li>
                    <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#" style="font-size: 13px; padding: 4px 10px;">3</a></li>
                    <li class="page-item disabled"><a class="page-link bg-transparent border-0 text-white-50" href="#" style="font-size: 13px; padding: 4px 10px;">...</a></li>
                    <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#" style="font-size: 13px; padding: 4px 10px;">14</a></li>
                    <li class="page-item"><a class="page-link bg-transparent border-0 text-white" href="#" style="font-size: 14px; padding: 4px 8px;">&gt;</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<div class="modal fade" id="adminTambahCategoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4" style="border-radius: 20px; border: none;">
            <div class="text-center mb-4 position-relative">
                <h4 class="m-0 fw-bold" id="categoryModalLabel" style="color: #3b82f6; letter-spacing: 0.5px; font-size: 24px; text-transform: uppercase;">Formulir Tambah Kategori</h4>
                <span style="color: #9ca3af; font-size: 12px; font-style: italic; margin-top: -5px; display: block;">SIGMA (ADMIN MODE)</span>
                <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formTambahCategory" onsubmit="prosesTambahCategory(event)">
                <div class="mb-4">
                    <label class="form-label" style="font-size: 11px; font-weight: 700; color: #6b7280; letter-spacing: 0.5px; text-transform: uppercase;">ID Kategori</label>
                    <input type="text" class="form-control text-muted" value="category_06" readonly style="border: 2px solid #e5e7eb; background-color: #f9fafb; border-radius: 8px; padding: 12px 16px; font-size: 14px; font-weight: 600;">
                </div>

                <div class="mb-4">
                    <label class="form-label" style="font-size: 11px; font-weight: 700; color: #6b7280; letter-spacing: 0.5px; text-transform: uppercase;">Nama Kategori</label>
                    <input type="text" class="form-control" required placeholder="Contoh: Bahan Kimia Elektrik" style="border: 2px solid #d1d5db; border-radius: 8px; padding: 12px 16px; font-size: 14px;">
                </div>

                <div class="text-center mt-2">
                    <button type="submit" class="btn text-white fw-bold text-uppercase" style="background-color: #2563eb; border-radius: 8px; padding: 14px; width: 160px; font-size: 14px; border: none; letter-spacing: 0.5px;">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function bukaModeEdit(index) {
        var row = document.getElementById('row-' + index);
        row.querySelector('.text-view').classList.add('d-none');
        row.querySelector('.text-edit').classList.remove('d-none');
        row.querySelector('.action-view').classList.add('d-none');
        
        var editAction = row.querySelector('.action-edit');
        editAction.classList.remove('d-none');
        editAction.classList.add('d-flex');
    }

    function simpanModeEdit(index) {
        var row = document.getElementById('row-' + index);
        var inputVal = document.getElementById('input-' + index).value;
        
        row.querySelector('.text-view').innerText = inputVal;
        row.querySelector('.text-view').classList.remove('d-none');
        row.querySelector('.text-edit').classList.add('d-none');
        row.querySelector('.action-view').classList.remove('d-none');
        
        var editAction = row.querySelector('.action-edit');
        editAction.classList.add('d-none');
        editAction.classList.remove('d-flex');
        
        // Ganti teks notif ke mode EDIT
        document.getElementById('textNotifCategory').innerText = "Kategori berhasil diubah";
        var notif = document.getElementById('notifSuksesCategory');
        notif.classList.remove('d-none');
        
        setTimeout(function() { tutorTutupNotif(); }, 4000);
    }

    // FUNGSI PROSES POP-UP TAMBAH KATEGORI BARU
    function prosesTambahCategory(event) {
        event.preventDefault(); // Mengunci halaman biar gak mental error

        // Tutup modal secara programmatic
        var modalElemen = document.getElementById('adminTambahCategoryModal');
        var modalInstance = bootstrap.Modal.getInstance(modalElemen);
        modalInstance.hide();

        // Ganti teks notif ke mode TAMBAH
        document.getElementById('textNotifCategory').innerText = "Kategori berhasil ditambahkan";
        var notif = document.getElementById('notifSuksesCategory');
        notif.classList.remove('d-none');

        // Reset isi form teks inputan biar kosong lagi
        document.getElementById('formTambahCategory').reset();

        setTimeout(function() { tutorTutupNotif(); }, 4000);
    }

    function hapusBaris(index) {
        if(confirm("Hapus kategori ini dari sistem SIGMA?")) {
            document.getElementById('row-' + index).remove();
        }
    }

    function tutorTutupNotif() {
        var notif = document.getElementById('notifSuksesCategory');
        if(notif) { notif.classList.add('d-none'); }
    }
    
    function tutupNotif() {
        tutorTutupNotif();
    }
</script>
@endsection