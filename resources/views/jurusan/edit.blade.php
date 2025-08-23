@foreach ($jrsn as $dpt)
    <div class="modal fade" id="modalUpdate{{ $dpt -> id }}" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalUpdateLabel">Edit Jurusan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form action="{{ url('jurusan/'. $id = $dpt -> id ) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Nama Jurusan</label>
                        <input type="text" name="namajurusan" class="form-control @error('namajurusan') is-invalid @enderror" id="jurusan" value="{{ old('namajurusan', $dpt -> nama_jurusan) }}">
                        @error('namajurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endforeach
