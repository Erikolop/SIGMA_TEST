@extends('layouts.app')

@section('header_title', 'Staff Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="search-box">
        <input type="text" class="form-control" placeholder="Search..." style="width: 300px; border-radius: 10px;">
    </div>
    <button class="btn btn-dark" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#modalAddUser">
        <i class="fas fa-user-plus"></i> Add User
    </button>
</div>

<div class="card overflow-hidden">
    <table class="table table-hover m-0">
        <thead class="table-primary" style="background-color: var(--sigma-purple) !important; color: white;">
            <tr>
                <th class="ps-4"><input type="checkbox" class="form-check-input"></th>
                <th>FULL NAME</th>
                <th>EMAIL</th>
                <th>USERNAME</th>
                <th>ROLE</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach(['Daffa', 'Erghy', 'Ciko'] as $name)
            <tr>
                <td class="ps-4"><input type="checkbox" class="form-check-input"></td>
                <td class="fw-bold">{{ $name }}</td>
                <td>{{ strtolower($name) }}666@gmail.com</td>
                <td>{{ strtolower($name) }}</td>
                <td>Admin</td>
                <td>
                    <button class="btn btn-sm text-primary" data-bs-toggle="modal" data-bs-target="#modalEditUser"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-sm text-danger" onclick="alert('Simulasi Hapus: User berhasil dihapus! (Statis)')"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="bg-primary p-2 d-flex justify-content-end" style="background-color: var(--sigma-purple) !important;">
        <nav>
          <ul class="pagination pagination-sm m-0">
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
          </ul>
        </nav>
    </div>
</div>

<div class="modal fade" id="modalAddUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 15px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold text-dark m-0">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4">
                <form onsubmit="event.preventDefault(); alert('Simulasi: Berhasil menambahkan user baru! (Statis)'); window.location.reload();">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted" style="font-size: 12px;">FULL NAME</label>
                        <input type="text" class="form-control" style="background-color: #f3f4f6; border: none; border-radius: 10px; padding: 12px;" placeholder="Enter full name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted" style="font-size: 12px;">EMAIL</label>
                        <input type="email" class="form-control" style="background-color: #f3f4f6; border: none; border-radius: 10px; padding: 12px;" placeholder="example666@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted" style="font-size: 12px;">USERNAME</label>
                        <input type="text" class="form-control" style="background-color: #f3f4f6; border: none; border-radius: 10px; padding: 12px;" placeholder="Enter username" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted" style="font-size: 12px;">ROLE</label>
                        <select class="form-select" style="background-color: #f3f4f6; border: none; border-radius: 10px; padding: 12px;" required>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 fw-bold py-3 shadow-sm" style="border-radius: 25px;">Save User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 15px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold text-dark m-0">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4">
                <form onsubmit="event.preventDefault(); alert('Simulasi: Perubahan data user berhasil disimpan! (Statis)'); window.location.reload();">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted" style="font-size: 12px;">FULL NAME</label>
                        <input type="text" class="form-control" style="background-color: #f3f4f6; border: none; border-radius: 10px; padding: 12px;" value="Erghy" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted" style="font-size: 12px;">EMAIL</label>
                        <input type="email" class="form-control" style="background-color: #f3f4f6; border: none; border-radius: 10px; padding: 12px;" value="erghy666@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted" style="font-size: 12px;">USERNAME</label>
                        <input type="text" class="form-control" style="background-color: #f3f4f6; border: none; border-radius: 10px; padding: 12px;" value="erghy" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted" style="font-size: 12px;">ROLE</label>
                        <select class="form-select" style="background-color: #f3f4f6; border: none; border-radius: 10px; padding: 12px;" required>
                            <option value="Admin" selected>Admin</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 fw-bold py-3 shadow-sm" style="border-radius: 25px;">Update Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection