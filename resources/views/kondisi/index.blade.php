@extends('layouts.main')
@section('content')
  <div class="card-body" style="background-color: rgb(255, 255, 255)" >
    <div class="d-sm-flex d-block align-items-center justify-content-between">
      <div class="mb-3 mb-sm-0">
        <h5 class="card-title fw-semibold mb-3">Kondisi</h5>
        <a href="" class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</a>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kondisi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('kondisi') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi</label>
                        <input type="text" name="namakondisi" class="form-control @error('namakondisi') is-invalid @enderror" id="kondisi" value="{{ old('namakondisi') }}">
                        @error('namakondisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                 </form>
            </div>
            </div>
        </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
        <table id="tabeldata" class="table table-striped table-hover mt-5" >
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Kondisi</th>
            <th scope="col">Jumlah Barang</th>
            <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($condition as $cdt)
            <tr>
                <td scope="row">{{ $loop -> iteration }}</td>
                <td>{{ $cdt -> nama_kondisi }}</td>
                <td>{{ $cdt -> total_stok_masuk}}</td>
                <td>
                    <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $cdt -> id }}"><i class="ti ti-edit"></i></a>
                    <a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $cdt -> id }}"><i class="ti ti-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
  </div>


  <!-- Modal Create-->
  @include('kondisi.add')
  {{-- modal Update --}}
  @include('kondisi.edit')
  {{-- Modal Delete --}}
  @include('kondisi.delete')
@endsection
