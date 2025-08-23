@extends('layouts.main')
@section('content')
<div class="card-body" style="background-color: rgb(255, 255, 255)">
    <div class="">
        <div class="mb-sm-0 row">
            <div class="col-md-4">
                <h5 class="card-title fw-semibold mb-3">Laporan Barang Masuk</h5>
                {{-- <a href="" class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah Data</a> --}}
                <!-- <a href="{{ url('barang-masuk/create') }}" class="btn btn-outline-primary mb-3">Tambah Data</a> -->
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
                        <button id="filterLaporanBarangMasuk" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @error('namabarang')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    <!-- Form untuk filter tanggal -->

    <div class="table-responsive">
        <table id="tabellaporanBarangMasuk" class="table table-striped table-hover mt-5"
            data-url="{{ route("barangMasuk.report") }}">
            <thead>
                <tr>
                    <th scope="col" style="width: 20px">No</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Merk</th>
                    <th scope="col" style="width: 20px">Jumlah</th>
                    <th scope="col">Kondisi</th>
                    <th scope="col">Ruang</th>
                    <th scope="col">Keterangan</th>
                    <!-- <th scope="col">Opsi</th> -->
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal Create-->
{{-- @include('barangMasuk.add') --}}
{{-- modal Update --}}
{{-- @include('barangMasuk.edit') --}}
{{-- Modal Delete --}}
<!-- @include('barangMasuk.delete') -->
@endsection
