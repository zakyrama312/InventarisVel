@foreach ($peminjaman as $pj)
<!-- Modal Reject -->
<div class="modal fade" id="modalReject{{ $pj->id }}" tabindex="-1" aria-labelledby="modalRejectLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalRejectLabel">Reject Peminjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('peminjaman.reject', $pj->id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="keterangan_reject" class="form-label">Keterangan Reject</label>
                        <textarea name="keterangan_reject" class="form-control" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach