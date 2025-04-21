<?php
// Debug data
log_message('debug', 'Delete form data: ' . print_r($data, true));
?>
<div class="modal fade" id="modal-hapus-barang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="form-hapus-barang" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <p class="mb-3">Apakah anda yakin akan menghapus barang ini?</p>
                    
                    <input type="hidden" name="id" value="<?= $data->id ?>">
                    <input type="hidden" name="kode" value="<?= $data->kode ?>">
                    
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label">Kode</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data->kode ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data->nama ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="bi bi-x"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#form-hapus-barang').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '/admin/master_barang/delete',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('button[type="submit"]').prop('disabled', true)
                    .html('<i class="spinner-border spinner-border-sm"></i> Processing...');
            },
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil dihapus',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#modal-hapus-barang').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Gagal menghapus data'
                    });
                }
            }
        });
    });
});
</script>