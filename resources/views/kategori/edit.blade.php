@foreach ($categories as $ktg)
    <div class="modal fade" id="modalUpdate{{ $ktg -> id }}" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalUpdateLabel">Edit Kategori</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form action="{{ url('kategori/'. $id = $ktg -> id ) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Nama Kategori</label>
                        <input type="text" name="namakategori" class="form-control @error('namakategori') is-invalid @enderror" id="kategori" value="{{ old('namakategori', $ktg -> nama_kategori) }}">
                        @error('namakategori')
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