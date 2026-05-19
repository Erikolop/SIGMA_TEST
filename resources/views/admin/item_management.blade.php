@extends('layouts.app')

@section('title', 'Item Management (Admin) - SIGMA')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    .content-body { padding: 30px 40px !important; background-color: #f4f5f9; }
    .page-title-center { text-align: center; font-size: 28px; font-weight: 800; color: #1e1b4b; margin-top: 10px; margin-bottom: 40px; letter-spacing: 0.5px; }
    .alert-success-figma { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; padding: 12px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    .search-action-bar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; gap: 20px; }
    .left-action-controls { display: flex; align-items: center; gap: 20px; flex-grow: 1; }
    .search-wrapper { position: relative; max-width: 280px; width: 100%; }
    .search-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; }
    .search-wrapper .form-control { padding: 10px 15px 10px 42px; border-radius: 8px; border: 1px solid #d1d5db; font-size: 13px; background-color: #ffffff; }
    .search-by-group { display: flex; align-items: center; border: 1px solid #d1d5db; border-radius: 8px; overflow: hidden; background-color: #ffffff; }
    .search-by-label-box { background-color: #f9fafb; color: #374151; padding: 10px 15px; font-size: 13px; font-weight: 600; border-right: 1px solid #d1d5db; white-space: nowrap; }
    .dropdown-filter-select { border: none; background-color: #ffffff; color: #374151; font-weight: 600; font-size: 13px; padding: 10px 30px 10px 15px; cursor: pointer; outline: none; appearance: none; }
    .btn-add-item-dark { background-color: #1e1b4b; color: #ffffff; font-size: 12px; font-weight: 700; padding: 11px 22px; border-radius: 8px; border: none; display: flex; align-items: center; gap: 8px; cursor: pointer; }
    .table-card-staff { background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    .staff-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .staff-table thead th { background-color: #3f3d8f; color: #ffffff; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.8px; padding: 18px 20px; border: none; }
    .staff-table td { padding: 22px 20px; border-bottom: 1px solid #f3f4f6; vertical-align: middle; color: #4b5563; }
    .staff-table tbody tr:nth-child(even) { background-color: #f9fafb; }
    .action-container-cell { display: flex; align-items: center; justify-content: center; min-height: 34px; }
    .action-normal-layout, .action-edit-layout { display: flex; align-items: center; gap: 15px; font-size: 16px; }
    .icon-pen-grey { color: #9ca3af !important; cursor: pointer; }
    .icon-pen-grey:hover { color: #4b5563 !important; }
    .icon-trash-red { color: #ef4444 !important; cursor: pointer; }
    .icon-trash-red:hover { color: #dc2626 !important; }
    .qty-number-browser { width: 65px; height: 32px; padding: 4px 6px; border: 1px solid #d1d5db; border-radius: 6px; font-weight: 700; font-size: 14px; text-align: center; outline: none; }
    .btn-submit-green-circle { background-color: #22c55e; color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px; border: none; cursor: pointer; }
    .footer-purple-bar { background-color: #2e2a85; color: #ffffff; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; }
    .pg-container { display: flex; gap: 6px; align-items: center; }
    .pg-container a { color: rgba(255, 255, 255, 0.6); text-decoration: none; padding: 4px 10px; font-weight: 600; }
    .active-page-box { background-color: #2563eb; color: #ffffff !important; border-radius: 4px; }
    .modal-overlay-custom { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(30, 41, 59, 0.6); display: flex; align-items: center; justify-content: center; z-index: 9999; }
    .modal-card-custom { background-color: #ffffff; width: 560px; border-radius: 16px; padding: 35px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); max-height: 90vh; overflow-y: auto; }
    .modal-overlay-delete { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(30, 41, 59, 0.6); display: flex; align-items: center; justify-content: center; z-index: 9999; }
    .modal-card-delete { background-color: #ffffff; width: 450px; border-radius: 14px; padding: 35px; text-align: center; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15); }
    .icon-warning-box { color: #ef4444; font-size: 48px; margin-bottom: 15px; }
    .delete-modal-title { color: #1e293b; font-size: 18px; font-weight: 700; margin-bottom: 10px; }
    .delete-modal-text { color: #64748b; font-size: 13px; line-height: 1.5; margin-bottom: 25px; }
    .btn-modal-action { padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; }
    .btn-cancel-grey { background-color: #f1f5f9; color: #475569; }
    .btn-confirm-red { background-color: #ef4444; color: #ffffff; }
    [x-cloak] { display: none !important; }
</style>

<div x-data="{ openAddModal: false, openDeleteModal: false, showNotification: false, successMessage: '', targetItemName: '', targetItemId: 0, editingId: null }">

    <h2 class="page-title-center">Item Management</h2>

    @if(session('success'))
    <div class="alert-success-figma">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="search-action-bar">
        <form method="GET" action="{{ route('Item') }}" class="d-flex align-items-center gap-3" style="flex-grow:1;">
            <div class="left-action-controls">
                <div class="search-wrapper">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                </div>
                <div class="search-by-group">
                    <div class="search-by-label-box">Search By:</div>
                    <select name="search_by" class="dropdown-filter-select" onchange="this.form.submit()">
                        <option value="item" {{ request('search_by') == 'item' ? 'selected' : '' }}>Item</option>
                        <option value="category" {{ request('search_by') == 'category' ? 'selected' : '' }}>Category Item</option>
                    </select>
                </div>
            </div>
        </form>

        {{-- Add Item button — admin only --}}
        @if(Auth::user()->role === 'Admin')
        <button type="button" class="btn-add-item-dark shadow-sm" @click="openAddModal = true">
            <i class="fa-solid fa-plus"></i> Add Item
        </button>
        @endif
    </div>

    <div class="table-card-staff">
        <table class="staff-table text-center align-middle">
            <thead>
                <tr>
                    <th style="width: 35%;" class="text-start ps-5">Nama Item</th>
                    <th style="width: 25%;" class="text-start">Category Item</th>
                    <th style="width: 15%;" class="text-start">Stock Item</th>
                    <th style="width: 25%;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td class="text-start ps-5 fw-bold" style="color: #111827;">{{ $item->item_name }}</td>
                    <td class="text-start" style="color: #4b5563; font-weight: 500;">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td class="text-start fw-bold" style="color: #111827;">{{ $item->item_qty }}</td>
                    <td>
                        <div class="action-container-cell">
                            <div class="action-normal-layout" x-show="editingId !== {{ $item->id }}">
                                <i class="fa-solid fa-pen icon-pen-grey" @click="editingId = {{ $item->id }}"></i>
                            </div>

                            <div class="action-edit-layout" x-show="editingId === {{ $item->id }}" x-cloak>
                                <i class="fa-solid fa-pen icon-pen-grey" style="color: #4b5563 !important;" @click="editingId = null"></i>

                                <i class="fa-solid fa-trash-can icon-trash-red"
                                   @click="targetItemName = '{{ addslashes($item->item_name) }}'; targetItemId = {{ $item->id }}; openDeleteModal = true"></i>

                                <form method="POST" action="{{ route('editItem', $item->id) }}" class="d-flex align-items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="item_name" value="{{ $item->item_name }}">
                                    <input type="hidden" name="id_kategori" value="{{ $item->id_kategori }}">
                                    <input type="number" name="item_qty" class="qty-number-browser" value="{{ $item->item_qty }}" min="0">
                                    <button type="submit" class="btn-submit-green-circle" title="Simpan Perubahan">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">Belum ada data barang</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer-purple-bar">
            <div>Rows per page: 10 | {{ $items->firstItem() ?? 0 }}-{{ $items->lastItem() ?? 0 }} of {{ $items->total() }} rows</div>
            <div class="pg-container">
                <a href="{{ $items->previousPageUrl() ?? '#' }}"><i class="fa-solid fa-chevron-left"></i></a>
                @foreach($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="{{ $page == $items->currentPage() ? 'active-page-box' : '' }}">{{ $page }}</a>
                @endforeach
                <a href="{{ $items->nextPageUrl() ?? '#' }}"><i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

    {{-- Modal Add Item (Admin only) --}}
    <div class="modal-overlay-custom" x-show="openAddModal" x-transition.opacity x-cloak>
        <div class="modal-card-custom" @click.away="openAddModal = false"
             x-data="{
                 items: [{ item_name: '', id_kategori: '', item_qty: 0 }],
                 maxItems: 3,
                 addRow() {
                     if (this.items.length < this.maxItems) {
                         this.items.push({ item_name: '', id_kategori: '', item_qty: 0 });
                     }
                 },
                 removeRow(index) {
                     if (this.items.length > 1) {
                         this.items.splice(index, 1);
                     }
                 }
             }">
            <h4 class="text-center mb-4" style="color: #3f3d8f; font-weight: 700;">ADD NEW ITEM</h4>
            <form method="POST" action="{{ route('addItems') }}">
                @csrf

                <template x-for="(item, index) in items" :key="index">
                    <div class="border rounded p-3 mb-3" style="position: relative;">
                        {{-- Row label + remove button --}}
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="fw-bold" style="font-size: 13px; color: #3f3d8f;">
                                Item <span x-text="index + 1"></span>
                            </div>
                            <button type="button"
                                    x-show="items.length > 1"
                                    @click="removeRow(index)"
                                    class="btn btn-sm"
                                    style="color: #ef4444; background: none; border: none; font-size: 13px; padding: 0; cursor: pointer;"
                                    title="Hapus baris ini">
                                <i class="fa-solid fa-xmark"></i> Hapus
                            </button>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-bold" style="font-size: 12px;">Nama Item</label>
                            <input type="text"
                                   :name="'items[' + index + '][item_name]'"
                                   x-model="item.item_name"
                                   class="form-control form-control-sm"
                                   placeholder="Nama barang"
                                   required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold" style="font-size: 12px;">Kategori</label>
                            <select :name="'items[' + index + '][id_kategori]'"
                                    x-model="item.id_kategori"
                                    class="form-select form-select-sm"
                                    required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label fw-bold" style="font-size: 12px;">Stok Awal</label>
                            <input type="number"
                                   :name="'items[' + index + '][item_qty]'"
                                   x-model="item.item_qty"
                                   class="form-control form-control-sm"
                                   value="0" min="0"
                                   required>
                        </div>
                    </div>
                </template>

                {{-- Add more row button --}}
                <button type="button"
                        @click="addRow()"
                        x-show="items.length < maxItems"
                        class="btn btn-sm w-100 mb-3"
                        style="border: 1px dashed #3f3d8f; color: #3f3d8f; background: #f8f9ff; font-size: 13px; font-weight: 600; border-radius: 8px; padding: 8px;">
                    <i class="fa-solid fa-plus me-1"></i>
                    Tambah Item (<span x-text="maxItems - items.length"></span> slot tersisa)
                </button>

                <div class="d-flex justify-content-end gap-2 mt-1">
                    <button type="button" class="btn btn-secondary btn-sm" @click="openAddModal = false; items = [{ item_name: '', id_kategori: '', item_qty: 0 }]">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm" style="background-color: #3f3d8f; border: none;">
                        Simpan (<span x-text="items.length"></span> item)
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Delete Item --}}
    <div class="modal-overlay-delete" x-show="openDeleteModal" x-transition.opacity x-cloak>
        <div class="modal-card-delete" @click.away="openDeleteModal = false">
            <div class="icon-warning-box"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="delete-modal-title">Yakin mau menghapus barang ini?</div>
            <div class="delete-modal-text">
                Barang <strong class="text-dark" x-text="targetItemName"></strong> bakal dihapus dari sistem.
            </div>
            <form method="POST" :action="'{{ url('/item/delete') }}/' + targetItemId">
                @csrf
                @method('DELETE')
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn-modal-action btn-cancel-grey" @click="openDeleteModal = false">Batal</button>
                    <button type="submit" class="btn-modal-action btn-confirm-red">HAPUS</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
