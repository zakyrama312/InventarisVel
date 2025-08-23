<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateLabel">Tambah Pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('pengguna') }}" method="post">
                    @csrf
                    <div class="mb-2">
                        <label for="pengguna" class="form-label">Nama Pengguna</label>
                        <input type="text" name="namapengguna"
                            class="form-control @error('namapengguna') is-invalid @enderror" id="pengguna"
                            value="{{ old('namapengguna') }}">
                        @error('namapengguna')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="pengguna" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> -->
                    <div class="mb-2">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            id="pengguna" value="{{ old('username') }}">
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="pengguna"
                            value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="" class="form-control" required>
                            <option value="">--Pilih-Role</option>
                            <option value="admin">Admin</option>
                            <option value="anggota">Anggota</option>
                            <option value="kaprodi">Kaprodi</option>
                        </select>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select name="jurusan" id="" class="form-control" required>
                            <option value="">--Pilih-Jurusan</option>
                            @foreach ($jurusan as $jrs)
                            <option value="{{ $jrs->id }}">{{ $jrs->nama_prodi }}</option>
                            @endforeach
                        </select>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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