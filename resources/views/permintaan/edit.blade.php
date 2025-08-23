@foreach ($permintaan as $pj)
<div class="modal fade" id="modalUpdate{{ $pj -> id }}" tabindex="-1" aria-labelledby="modalUpdateLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalUpdateLabel">Permintaan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('permintaan/'. $id = $pj -> id ) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-3" style="color: black">
                        Barang {{ $pj->barangMasuk->nama_barang }} apakah disetujui?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-success">Setujui</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endforeach