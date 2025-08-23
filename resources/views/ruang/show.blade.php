@extends('layouts.main')
@section('content')
<div class="card-body" style="background-color: rgb(255, 255, 255)">
    <div class="mb-3 row">
        <div class="col-md-6">
            <h5 class="card-title fw-semibold mb-5">Ruang {{ $ruang->nama_ruang }}</h5>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('print/'.$ruang->slug) }}" class="btn btn-primary" title="Print"><i
                    class="ti ti-printer"></i></a>
        </div>
    </div>
    <div class="table-responsive">
        <table id="tabeldata" class="table table-striped table-hover mt-5">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Kondisi</th>
                    <th scope="col">Ruang</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangmasuk as $r)
                <tr>
                    <td scope="row">{{ $loop -> iteration }}</td>
                    <td>{{ $r->nama_barang }}</td>
                    <td>{{ $r->merk }}</td>
                    <td>{{ $r->barangstoks->sum('stok_masuk') }}</td>
                    <td>{{ $r->kondisi->nama_kondisi }}</td>
                    <td>{{ $r->ruang->nama_ruang }}</td>
                    <td>{{ $r->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection