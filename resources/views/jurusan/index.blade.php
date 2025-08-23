@extends('layouts.main')
@section('content')
<div class="card-body" style="background-color: rgb(255, 255, 255)">
    <div class="d-sm-flex d-block align-items-center justify-content-between">
        <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold mb-3">Jurusan</h5>
            {{-- <a href="" class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah Data</a> --}}

        </div>
    </div>
    @error('namajurusan')
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
                    <th scope="col">Jurusan</th>
                    <th scope="col">Jumlah Barang</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jrsn as $dpt)
                <tr>
                    <th scope="row">{{ $loop -> iteration }}</th>
                    <td>{{ $dpt -> nama_prodi }}</td>
                    <td>{{ $dpt -> total_stok_masuk }}</td>
                    <td>
                        <a href="" class="btn btn-outline-warning" data-bs-toggle="modal"
                            data-bs-target="#modalUpdate{{ $dpt -> id }}"><i class="ti ti-edit"></i></a>
                        {{-- <a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $dpt -> id }}"><i
                            class="ti ti-trash"></i></a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Create-->
@include('jurusan.add')
{{-- modal Update --}}
@include('jurusan.edit')
{{-- Modal Delete --}}
@include('jurusan.delete')
@endsection