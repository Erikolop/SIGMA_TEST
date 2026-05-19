@extends('layouts.app')

@section('title', 'Activity Log')

@section('content')
<div class="container-fluid">
    <div class="d-flex border-bottom mb-4">
        <div class="pb-2 border-bottom border-warning border-3 text-warning fw-bold px-3">Activity Log</div>
    </div>

    <form method="GET" action="{{ route('activityLog') }}" class="d-flex gap-2 align-items-center mb-4">
        <div class="input-group" style="width: 300px;">
            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
            <input type="text" name="search" class="form-control border-start-0" placeholder="Search" value="{{ request('search') }}" style="box-shadow: none;">
        </div>
        <input type="date" name="date" class="form-control" style="width:180px;" value="{{ request('date') }}">
        <button type="submit" class="btn btn-light border text-dark px-3"><i class="fas fa-calendar-alt fs-5"></i></button>
    </form>

    <div class="card overflow-hidden shadow-sm border-0" style="border-radius: 12px;">
        <table class="table mb-0 text-center align-middle" style="font-size: 14px;">
            <thead class="bg-light text-muted small">
                <tr>
                    <th class="py-3 text-start ps-4">SOURCE</th>
                    <th>TIME</th>
                    <th>NAME</th>
                    <th>ITEM</th>
                    <th>INITIAL</th>
                    <th>ADJUSTMENT</th>
                    <th>REMAINING</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td class="text-start ps-4">
                        @if($log->jenis_mutasi === 'Order Out')
                            <i class="fas fa-shopping-cart text-danger me-2"></i> Order Out
                        @else
                            <i class="fas fa-shopping-cart text-success me-2"></i> Order In
                        @endif
                    </td>
                    <td class="text-muted">{{ $log->tgl_transaksi ? $log->tgl_transaksi->format('M d, H:i') : '-' }}</td>
                    <td>{{ $log->nama_user }}</td>
                    <td>{{ $log->nama_item }}</td>
                    <td>{{ number_format($log->sebelum_qty) }}</td>
                    <td class="{{ $log->jenis_mutasi === 'Order Out' ? 'text-danger' : 'text-success' }} fw-bold">
                        {{ $log->jenis_mutasi === 'Order Out' ? '-' : '+' }}{{ number_format($log->perubahan_qty) }}
                    </td>
                    <td class="fw-bold">{{ number_format($log->sebelum_qty + ($log->jenis_mutasi === 'Order In' ? $log->perubahan_qty : -$log->perubahan_qty)) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Belum ada aktivitas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="p-2 d-flex justify-content-between align-items-center text-white" style="background-color: #3f3d8f;">
            <small class="ms-3">Showing {{ $logs->firstItem() ?? 0 }}-{{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }} records</small>
            <nav>
                <ul class="pagination pagination-sm mb-0 me-3">
                    <li class="page-item {{ $logs->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link bg-transparent border-0 text-white" href="{{ $logs->previousPageUrl() }}">&lt;</a>
                    </li>
                    @foreach($logs->getUrlRange(1, $logs->lastPage()) as $page => $url)
                    <li class="page-item">
                        <a class="page-link {{ $page == $logs->currentPage() ? 'text-dark fw-bold' : 'bg-transparent border-0 text-white' }}" href="{{ $url }}" style="{{ $page == $logs->currentPage() ? 'border-radius: 4px; padding: 2px 8px;' : '' }}">{{ $page }}</a>
                    </li>
                    @endforeach
                    <li class="page-item {{ !$logs->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link bg-transparent border-0 text-white" href="{{ $logs->nextPageUrl() }}">&gt;</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection