@extends('layouts.main')
@section('content')

<div class="card-body" style="background-color: rgb(255, 255, 255)">
    <div class="">
        <div class="mb-sm-0 row">
            <div class="col-md-4">
                <h5 class="card-title fw-semibold mb-3">Peminjaman</h5>
                <a href="" class="btn btn-outline-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#modalCreate">Tambah Data</a>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <label for="" style="color: black" class="mb-3">Filter Tanggal</label>
                    <div class="col-md-5">
                        <input type="date" id="start_date" name="start_date" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <input type="date" id="end_date" name="end_date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button id="filter1" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @error('namajurusan')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    @if (session('pesan'))
    <div class="alert alert-warning">
        {{ session('pesan') }}
    </div>
    @endif
    <div class="table-responsive">
        <table id="tabeldataPeminjaman" class="table table-striped table-hover mt-5"
            data-url="{{ route("peminjaman.index") }}">
            <thead>
                <tr>
                    <th scope="col" style="width: 20px">No</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Barang</th>
                    <th scope="col" style="width: 20px">Jumlah</th>
                    <th scope="col">Peminjam</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Keperluan</th>
                    <th scope="col">Tanggal Kembali</th>
                    <th scope="col">Status</th>
                    @if(Auth::user()->role == 'admin')
                    <th scope="col" style="text-align: center">Opsi</th>
                    @endif
                </tr>
            </thead>
        </table>

    </div>
</div>


<!-- Modal Create-->
@include('peminjaman.add')
{{-- modal Update --}}
@include('peminjaman.edit')
{{-- Modal Delete --}}
@include('peminjaman.delete')
{{-- Modal Reject --}}
@include('peminjaman.reject')
{{-- Modal Approve --}}
@include('peminjaman.approve')
@endsection