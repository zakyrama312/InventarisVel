<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateLabel">Permintaan Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('permintaan') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="ruang" class="form-label">Nama Barang</label>
                            <select id="country" class="form-control" name="namabarang">
                                <option value="">Cari Barang</option>
                                @foreach ($barang as $b)
                                <option value="{{ $b->id }}">{{ $b->nama_barang }} {{ $b->merk }}
                                    {{ $b->ruang->nama_ruang }}
                                </option>
                                @endforeach
                            </select>
                            @error('namabarang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="ruang" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah"
                                class="form-control @error('jumlah') is-invalid @enderror" id="ruang"
                                value="{{ old('jumlah') }}" min="0">
                            @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="ruang" class="form-label">Nama Peminta</label>
                        <input type="text" name="namapeminjam"
                            class="form-control @error('namapeminjam') is-invalid @enderror" id="ruang"
                            value="{{ old('namapeminjam') }}">
                        @error('namapeminjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label for="ruang" class="form-label">Kelas</label>
                            <input type="text" class="form-control  @error('kelas') is-invalid @enderror" name="kelas">
                            @error('kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <label for="ruang" class="form-label">Keperluan</label>
                            <textarea name="keperluan"
                                class="form-control @error('keperluan') is-invalid @enderror"></textarea>
                            @error('keperluan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>