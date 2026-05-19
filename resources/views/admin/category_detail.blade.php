@extends('layouts.app')

@section('title', 'Detail Category - SIGMA')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    .content-body { padding: 40px 50px !important; background-color: #f4f5f9; }
    .btn-return-figma { background-color: #bfdbfe; color: #2563eb; border: none; padding: 6px 18px; border-radius: 50px; font-size: 13px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-return-figma i { transform: rotate(180deg); }
    .detail-header-section { text-align: center; margin-top: -10px; margin-bottom: 35px; }
    .detail-header-section h2 { font-size: 32px; font-weight: 800; color: #1e1b4b; margin: 0; }
    .detail-header-section p { font-size: 26px; color: #1e1b4b; font-weight: 600; margin-top: 5px; margin-bottom: 0; }
    .alert-success-figma { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; padding: 12px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    .action-bar-detail { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .search-detail-wrapper { position: relative; width: 280px; }
    .search-detail-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; }
    .search-detail-wrapper .form-control { padding: 10px 15px 10px 42px; border-radius: 8px; border: 1px solid #d1d5db; background-color: #ffffff; font-size: 13px; }
    .table-container-detail { background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02); }
    .table-detail { width: 100%; border-collapse: collapse; font-size: 13px; }
    .table-detail thead th { background-color: #3f3d8f; color: #ffffff; padding: 20px; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: 0.8px; border: none; }
    .table-detail tbody td { padding: 22px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .table-detail tbody tr:nth-child(even) { background-color: #f8fafc; }
    .text-item-name { font-weight: 700; color: #1e293b; font-size: 14px; }
    .text-item-stock { font-weight: 500; color: #64748b; font-size: 14px; }
    .action-wrapper-cell { display: flex; align-items: center; justify-content: center; min-height: 36px; }
    .action-direct-form { display: flex; align-items: center; gap: 15px; }
    .icon-trash-red { color: #ef4444 !important; cursor: pointer; border: none; background: none; padding: 0; font-size: 16px; }
    .icon-trash-red:hover { color: #dc2626 !important; }
    .qty-number-input { width: 70px; height: 34px; padding: 4px 8px; border: 1px solid #cbd5e1; border-radius: 6px; font-weight: 700; text-align: center; outline: none; color: #334155; }
    .btn-submit-check { background-color: #22c55e; color: #ffffff; width: 30px; height: 30px; border-radius: 50%; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 13px; }
    .btn-submit-check:hover { background-color: #16a34a; }
    .footer-detail { background-color: #2e2a85; color: #ffffff; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; }
    .pg-box-container { display: flex; gap: 5px; align-items: center; }
    .pg-box-container a { color: rgba(255,255,255,0.6); text-decoration: none; padding: 4px 10px; font-weight: 600; }
    .active-pg { background-color: #2563eb; color: white !important; border-radius: 4px; }
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

<div x-data="{ showNotification: false, successMessage: '', openDeleteModal: false, targetItemName: '', targetItemId: 0 }">

    <a href="{{ route('categoryManagement') }}" class="btn-return-figma">
        <i class="fa-solid fa-arrow-right-from-bracket"></i> Return to Category
    </a>

    <div class="detail-header-section">
        <h2>Detail Category</h2>
        <p>"{{ $category->nama_kategori }}"</p>
    </div>

    @if(session('success'))
    <div class="alert-success-figma">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="action-bar-detail">
        <form method="GET" action="{{ route('detailCategory', $category->id) }}" class="d-flex align-items-center gap-2">
            <div class="search-detail-wrapper">
                <i class="fa-solid fa-search"></i>
                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn btn-sm btn-secondary">Cari</button>
        </form>
    </div>

    <div class="table-container-detail">
        <table class="table-detail mb-0 text-center">
            <thead>
                <tr>
                    <th class="text-start ps-5" style="width: 40%;">Nama Item</th>
                    <th class="text-start" style="width: 30%;">Stock Item</th>
                    <th style="width: 30%;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td class="text-start ps-5 text-item-name">{{ $item->item_name }}</td>
                    <td class="text-start text-item-stock">{{ $item->item_qty }}</td>
                    <td>
                        <div class="action-wrapper-cell">
                            <div class="action-direct-form">
                                {{-- Edit stock form --}}
                                <form method="POST" action="{{ route('editItemFromDetail', [$category->id, $item->id]) }}" class="d-flex align-items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="item_name" value="{{ $item->item_name }}">
                                    <input type="number" name="item_qty" class="qty-number-input" value="{{ $item->item_qty }}" min="0">
                                    <button type="submit" class="btn-submit-check" title="Simpan Perubahan">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>

                                {{-- Delete button --}}
                                <button type="button" class="icon-trash-red"
                                    @click="targetItemName = '{{ addslashes($item->item_name) }}'; targetItemId = {{ $item->id }}; openDeleteModal = true">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">Belum ada item dalam kategori ini</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer-detail">
            <div>Rows per page: 10 | {{ $items->firstItem() ?? 0 }}-{{ $items->lastItem() ?? 0 }} of {{ $items->total() }} rows</div>
            <div class="pg-box-container">
                <a href="{{ $items->previousPageUrl() ?? '#' }}"><i class="fa-solid fa-chevron-left"></i></a>
                @foreach($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="{{ $page == $items->currentPage() ? 'active-pg' : '' }}">{{ $page }}</a>
                @endforeach
                <a href="{{ $items->nextPageUrl() ?? '#' }}"><i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

    {{-- Modal Delete Item --}}
    <div class="modal-overlay-delete" x-show="openDeleteModal" x-transition.opacity x-cloak>
        <div class="modal-card-delete" @click.away="openDeleteModal = false">
            <div class="icon-warning-box"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="delete-modal-title">Yakin mau menghapus item ini?</div>
            <div class="delete-modal-text">
                Item <strong class="text-dark" x-text="targetItemName"></strong> bakal dihapus dari sistem.
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
