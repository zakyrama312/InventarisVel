@extends('layouts.main')
@section('content')
  <div class="card-body">
    <div class="d-sm-flex d-block align-items-center justify-content-between">
      <div class="mb-3 mb-sm-0 card-title">
        <a href="{{ url('barang-masuk') }}" class="btn btn-sm btn-primary mb-4">Kembali</a>
        <h5 class=" fw-semibold">Barang Masuk</h5>
      </div>
  </div>

      <div class="mb-2 row">
        <form action="{{  url('barang-masuk/'. $id = $barangMasuk -> id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-2 row">
                <div class="col-md-6">
                    <label for="pengguna" class="form-label">Nama Barang</label>
                    <input type="text" name="namabarang" class="form-control @error('namabarang') is-invalid @enderror"  value="{{ old('namabarang', $barangMasuk -> nama_barang) }}" autofocus>
                    @error('namabarang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="pengguna" class="form-label">Kode Barang</label>
                    <input type="text" name="kodebarang" class="form-control @error('kodebarang') is-invalid @enderror"  value="{{ old('kodebarang', $barangMasuk -> kode_barang) }}">
                    @error('kodebarang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-md-3">
                    <label for="pengguna" class="form-label">Merk Barang</label>
                    <input type="text" name="merkbarang" class="form-control @error('merkbarang') is-invalid @enderror"  value="{{ old('merkbarang', $barangMasuk -> merk) }}">
                    @error('merkbarang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="pengguna" class="form-label">Stok Masuk</label>
                    <input type="text" name="stokmasuk" class="form-control @error('stokmasuk') is-invalid @enderror"  value="{{ old('stokmasuk', $barangMasuk -> stok_masuk) }}">
                    @error('stokmasuk')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="pengguna" class="form-label">Ukuran</label>
                    <input type="text" name="ukuran" class="form-control @error('ukuran') is-invalid @enderror"  value="{{ old('ukuran', $barangMasuk -> ukuran) }}">
                    @error('ukuran')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="pengguna" class="form-label">Bahan</label>
                    <input type="text" name="bahan" class="form-control @error('bahan') is-invalid @enderror"  value="{{ old('bahan', $barangMasuk -> bahan) }}">
                    @error('bahan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-md-3">
                    <label for="pengguna" class="form-label">Tahun Beli</label>
                    <input type="text" name="tahunbeli" inputmode="numeric" class="form-control @error('tahunbeli') is-invalid @enderror"  value="{{ old('tahunbeli', $barangMasuk -> tahun_beli) }}">
                    @error('tahunbeli')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="pengguna" class="form-label">Harga Beli</label>
                    <input type="text" name="hargabeli" inputmode="numeric" class="form-control @error('hargabeli') is-invalid @enderror"  value="{{ old('hargabeli', $barangMasuk -> harga_beli) }}">
                    @error('hargabeli')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="pengguna" class="form-label">Spesifikasi</label>
                    <textarea name="spesifikasi" class="form-control" @error('spesifikasi') is-invalid @enderror" >{{ old('spesifikasi', $barangMasuk -> spesifikasi) }}</textarea>
                    @error('spesifikasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="pengguna" class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" @error('keterangan') is-invalid @enderror"  >{{ old('keterangan', $barangMasuk -> keterangan) }}</textarea>
                    @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-md-4">
                    <label for="jurusan" class="form-label">Kategori</label>
                    <select name="kategori" id="" class="form-control" >
                        <option value="{{ $barangMasuk->kategori->id }}">{{ $barangMasuk->kategori->nama_kategori }}</option>
                        <option value="">--Pilih Kategori--</option>
                        @foreach ($kategori as $ktr)
                            <option value="{{ $ktr->id }}">{{ $ktr->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="role" class="form-label">Kondisi</label>
                    <select name="kondisi" class="form-control" >
                        <option value="{{ $barangMasuk->kondisi->id }}">{{ $barangMasuk->kondisi->nama_kondisi }}</option>
                        <option value="">--Pilih Kondisi--</option>
                        @foreach ($kondisi as $kd)
                            <option value="{{ $kd->id }}">{{ $kd->nama_kondisi }}</option>
                        @endforeach
                    </select>
                    @error('kondisi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="jurusan" class="form-label">Ruang</label>
                    <select name="ruang" id="" class="form-control" >
                        <option value="{{ $barangMasuk->ruang->id }}">{{ $barangMasuk->ruang->nama_ruang }}</option>
                        <option value="">--Pilih Ruang--</option>
                        @foreach ($ruang as $r)
                            <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                        @endforeach
                    </select>
                    @error('ruang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button> --}}
                <button type="submit" name="simpan" class="btn btn-primary">Edit</button>
            </div>
        </form>
        <p class="mt-5" style="color: red; font-size: 12px">*kolom Ukuran, Bahan, Tahun Beli, Spesifikasi, Keterangan bisa dikosongkan</p>
      </div>
@endsection
