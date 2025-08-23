@extends('layouts.main')
@section('content')
<div class="card-body" style="background-color: rgb(255, 255, 255)">
    <div class="d-sm-flex d-block align-items-center justify-content-between">
        <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold mb-3">Pengguna</h5>
            <a href="" class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah
                Data</a>
        </div>
    </div>
    @error('namapengguna')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    <div class="table-responsive">
        <table id="tabeldata" class="table table-striped table-hover mt-5">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pengguna</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $usr)
                <tr>
                    <th scope="row">{{ $loop -> iteration }}</th>
                    <td>{{ $usr -> name }}</td>
                    <td>{{ $usr -> username }}</td>
                    <td>{{ $usr -> role }}</td>
                    <td>
                        <a href="" class="btn btn-outline-warning" data-bs-toggle="modal"
                            data-bs-target="#modalUpdate{{ $usr -> id }}"><i class="ti ti-edit"></i></a>
                        <a href="" class="btn btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#modalDelete{{ $usr -> id }}"><i class="ti ti-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Create-->
@include('pengguna.add')
{{-- modal Update --}}
@include('pengguna.edit')
{{-- Modal Delete --}}
@include('pengguna.delete')
@endsection