@extends('layouts.app')

@section('header_title', 'Staff Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="search-box">
        <input type="text" class="form-control" placeholder="Search..." style="width: 300px; border-radius: 10px;">
    </div>
    <button class="btn btn-dark" style="border-radius: 10px;"><i class="fas fa-user-plus"></i> Add User</button>
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
                    <button class="btn btn-sm text-primary"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-sm text-danger"><i class="fas fa-trash"></i></button>
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
@endsection