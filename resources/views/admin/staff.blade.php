@extends('layouts.app')

@section('title', 'Staff Management - SIGMA')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    .content-body { padding: 30px 40px !important; background-color: #f4f5f9; }
    .page-title-center { text-align: center; font-size: 28px; font-weight: 800; color: #1e1b4b; margin-top: 10px; margin-bottom: 40px; letter-spacing: 0.5px; }
    .alert-success-figma { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; padding: 12px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
    .action-bar-staff { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .search-box-staff { position: relative; max-width: 280px; width: 100%; }
    .search-box-staff i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; }
    .search-box-staff .form-control { padding: 10px 15px 10px 42px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px; background-color: #ffffff; }
    .right-action-buttons { display: flex; align-items: center; gap: 12px; }
    .btn-add-user { background-color: #1e1b4b; color: #ffffff; font-size: 12px; font-weight: 700; padding: 11px 22px; border-radius: 8px; border: none; display: flex; align-items: center; gap: 8px; cursor: pointer; }
    .btn-delete-selected { background-color: #fee2e2; color: #991b1b; font-size: 12px; font-weight: 700; padding: 11px 20px; border-radius: 8px; border: 1px solid #fca5a5; display: flex; align-items: center; gap: 8px; cursor: pointer; }
    .btn-delete-selected:hover { background-color: #ffeeee; }
    .table-wrapper-staff { background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    .staff-table-admin { width: 100%; border-collapse: collapse; font-size: 13px; }
    .staff-table-admin thead th { background-color: #3f3d8f; color: #ffffff; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.8px; padding: 18px 15px; border: none; }
    .staff-table-admin td { padding: 16px 15px; border-bottom: 1px solid #f3f4f6; color: #4b5563; vertical-align: middle; }
    .row-selected-highlight { background-color: #eff6ff !important; }
    .td-checkbox { width: 60px; }
    .form-check-input-custom { width: 16px; height: 16px; cursor: pointer; border: 1px solid #d1d5db; border-radius: 4px; }
    .text-name-bold { font-weight: 700; color: #111827; }
    .text-normal-field { font-weight: 500; color: #4b5563; }
    .action-icons-box { display: flex; justify-content: center; align-items: center; gap: 20px; font-size: 16px; min-height: 32px; }
    .icon-edit-grey { color: #9ca3af !important; cursor: pointer; }
    .icon-edit-grey:hover { color: #4b5563 !important; }
    .icon-delete-red { color: #dc2626 !important; cursor: pointer; }
    .icon-delete-red:hover { color: #991b1b !important; }
    .modal-overlay-custom { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(30, 41, 59, 0.6); display: flex; align-items: center; justify-content: center; z-index: 9999; }
    .modal-card-custom { background-color: #ffffff; width: 500px; border-radius: 16px; padding: 35px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
    .modal-overlay-delete { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(30, 41, 59, 0.6); display: flex; align-items: center; justify-content: center; z-index: 9999; }
    .modal-card-delete { background-color: #ffffff; width: 450px; border-radius: 14px; padding: 35px; text-align: center; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15); }
    .icon-warning-box { color: #ef4444; font-size: 48px; margin-bottom: 15px; }
    .delete-modal-title { color: #1e293b; font-size: 18px; font-weight: 700; margin-bottom: 10px; }
    .delete-modal-text { color: #64748b; font-size: 13px; line-height: 1.5; margin-bottom: 25px; }
    .btn-modal-action { padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; }
    .btn-cancel-grey { background-color: #f1f5f9; color: #475569; }
    .btn-cancel-grey:hover { background-color: #e2e8f0; }
    .btn-confirm-red { background-color: #ef4444; color: #ffffff; }
    .btn-confirm-red:hover { background-color: #dc2626; }
    .footer-pagination-staff { background-color: #2e2a85; color: #ffffff; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; }
    .pg-staff-container { display: flex; gap: 6px; align-items: center; }
    .pg-staff-container a { color: rgba(255, 255, 255, 0.6); text-decoration: none; padding: 4px 10px; font-weight: 600; }
    .active-pg-box { background-color: #2563eb; color: #ffffff !important; border-radius: 4px; }
    [x-cloak] { display: none !important; }
</style>

@php
    $all_ids = $users->pluck('id')->toJson();
@endphp

<div x-data="{
    openAddModal: false,
    openEditModal: false,
    openDeleteModal: false,
    openBulkDeleteModal: false,
    targetStaffName: '',
    targetStaffId: 0,
    selectedUsers: [],
    allUserIds: {{ $all_ids }},
    editData: { id: 0, name: '', email: '', role: '' },
    toggleAll() {
        if (this.selectedUsers.length === this.allUserIds.length) {
            this.selectedUsers = [];
        } else {
            this.selectedUsers = [...this.allUserIds];
        }
    }
}">

    <h2 class="page-title-center">Staff Management</h2>

    @if(session('success'))
    <div class="alert-success-figma">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="action-bar-staff">
        <form method="GET" action="{{ route('staffManagement') }}" class="d-flex align-items-center gap-2">
            <div class="search-box-staff">
                <i class="fa-solid fa-search"></i>
                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn btn-sm btn-secondary">Cari</button>
        </form>

        <div class="right-action-buttons">
            <button x-show="selectedUsers.length > 0" x-transition x-cloak
                    class="btn-delete-selected shadow-sm" @click="openBulkDeleteModal = true">
                <i class="fa-solid fa-trash"></i> Delete Selected (<span x-text="selectedUsers.length"></span>)
            </button>
            <button class="btn-add-user shadow-sm" @click="openAddModal = true">
                <i class="fa-solid fa-user-plus"></i> Add User
            </button>
        </div>
    </div>

    <div class="table-wrapper-staff">
        <table class="staff-table-admin text-center align-middle">
            <thead>
                <tr>
                    <th class="td-checkbox">
                        <input type="checkbox" class="form-check-input form-check-input-custom"
                               @click="toggleAll()"
                               :checked="selectedUsers.length === allUserIds.length && allUserIds.length > 0">
                    </th>
                    <th style="width: 25%;" class="text-start">Full Name</th>
                    <th style="width: 30%;" class="text-start">Email</th>
                    <th style="width: 15%;" class="text-start">Role</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr :class="selectedUsers.includes({{ $u->id }}) ? 'row-selected-highlight' : ''">
                    <td class="td-checkbox">
                        <input type="checkbox" :value="{{ $u->id }}" class="form-check-input form-check-input-custom" x-model="selectedUsers">
                    </td>
                    <td class="text-start text-name-bold">{{ $u->name }}</td>
                    <td class="text-start text-normal-field">{{ $u->email }}</td>
                    <td class="text-start text-normal-field">{{ $u->role }}</td>
                    <td>
                        <div class="action-icons-box">
                            <i class="fa-solid fa-pen icon-edit-grey"
                               @click="editData = { id: {{ $u->id }}, name: '{{ addslashes($u->name) }}', email: '{{ $u->email }}', role: '{{ $u->role }}' }; openEditModal = true"></i>
                            <i class="fa-solid fa-trash-can icon-delete-red"
                               @click="targetStaffName = '{{ addslashes($u->name) }}'; targetStaffId = {{ $u->id }}; openDeleteModal = true"></i>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Belum ada data staff</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer-pagination-staff">
            <div>Rows per page: 10 | {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }} of {{ $users->total() }} rows</div>
            <div class="pg-staff-container">
                <a href="{{ $users->previousPageUrl() ?? '#' }}"><i class="fa-solid fa-chevron-left"></i></a>
                @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="{{ $page == $users->currentPage() ? 'active-pg-box' : '' }}">{{ $page }}</a>
                @endforeach
                <a href="{{ $users->nextPageUrl() ?? '#' }}"><i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

    {{-- Modal Add User --}}
    <div class="modal-overlay-custom" x-show="openAddModal" x-transition.opacity x-cloak>
        <div class="modal-card-custom" @click.away="openAddModal = false">
            <h4 class="text-center mb-4" style="color: #3f3d8f; font-weight: 700;">ADD NEW USER</h4>
            <form method="POST" action="{{ route('addStaff') }}">
                @csrf
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Contoh: user@gmail.com" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Min. 6 karakter" required minlength="6">
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary" style="font-size: 13px; font-weight: 600;" @click="openAddModal = false">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #3f3d8f; border: none; font-size: 13px; font-weight: 600;">Create</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit User --}}
    <div class="modal-overlay-custom" x-show="openEditModal" x-transition.opacity x-cloak>
        <div class="modal-card-custom" @click.away="openEditModal = false">
            <h4 class="text-center mb-4" style="color: #3f3d8f; font-weight: 700;">EDIT USER ACCOUNT</h4>
            <form method="POST" :action="'{{ url('/admin/staff/edit') }}/' + editData.id">
                @csrf
                @method('PUT')
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Full Name</label>
                    <input type="text" name="name" class="form-control" x-model="editData.name" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Email</label>
                    <input type="email" name="email" class="form-control" x-model="editData.email" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Role</label>
                    <select name="role" class="form-select" x-model="editData.role" required>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold" style="font-size: 13px;">Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" minlength="6">
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary" style="font-size: 13px; font-weight: 600;" @click="openEditModal = false">Cancel</button>
                    <button type="submit" class="btn btn-success" style="background-color: #22c55e; border: none; font-size: 13px; font-weight: 600;">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Delete Single --}}
    <div class="modal-overlay-delete" x-show="openDeleteModal" x-transition.opacity x-cloak>
        <div class="modal-card-delete" @click.away="openDeleteModal = false">
            <div class="icon-warning-box"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="delete-modal-title">Yakin mau ngehapus akun ini?</div>
            <div class="delete-modal-text">
                Akun staff <strong class="text-dark" x-text="targetStaffName"></strong> bakal dihapus permanen dari sistem SIGMA.
            </div>
            <form method="POST" :action="'{{ url('/admin/staff/delete') }}/' + targetStaffId">
                @csrf
                @method('DELETE')
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn-modal-action btn-cancel-grey" @click="openDeleteModal = false">Batal</button>
                    <button type="submit" class="btn-modal-action btn-confirm-red">Yoi, Hapus!</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Bulk Delete --}}
    <div class="modal-overlay-delete" x-show="openBulkDeleteModal" x-transition.opacity x-cloak>
        <div class="modal-card-delete" @click.away="openBulkDeleteModal = false">
            <div class="icon-warning-box"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="delete-modal-title">Yakin mau menghapus akun-akun ini?</div>
            <div class="delete-modal-text">
                Kamu memilih <strong class="text-danger" x-text="selectedUsers.length + ' akun staff'"></strong> sekaligus. Semuanya akan dihapus permanen.
            </div>
            <form method="POST" action="{{ route('bulkDeleteStaff') }}">
                @csrf
                <div x-html="selectedUsers.map(id => '<input type=\'hidden\' name=\'ids[]\' value=\'' + id + '\'>').join('')"></div>
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn-modal-action btn-cancel-grey" @click="openBulkDeleteModal = false">Batal</button>
                    <button type="submit" class="btn-modal-action btn-confirm-red">Yoi, Hapus Semua!</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
