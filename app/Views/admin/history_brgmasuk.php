<?php
$this->session = \Config\Services::session();
$this->extend('shared_pages/templete');
$this->section('content');
?>
<section class="section">
    <?= $this->include('shared_pages/alert') ?>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Pilih interval waktu</h5>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="tgl_faktur" class="form-label">Tanggal awal</label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" id="tglawal-his-in">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="tgl_faktur" class="form-label">Tanggal akhir</label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" id="tglakhir-his-in">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tampilkan history </label>
                    <div class="input-group mb-3">
                        <button type="button" class="btn btn-success" id="cari-his-brgmasuk">Cari &nbsp&nbsp<i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
            <div id="div-history-stock-in"></div>
        </div>
    </div>
</section>
<script>
$(document).ready(function() {
    $("#cari-his-brgmasuk").click(function() {
        let tglAwal = $("#tglawal-his-in").val();
        let tglAkhir = $("#tglakhir-his-in").val();

        // Validate dates
        if (!tglAwal || !tglAkhir) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Tanggal awal dan akhir harus diisi!',
                timer: 2000,
                timerProgressBar: true
            });
            return;
        }

        // Use data object instead of formData
        let data = {
            tglAwal: tglAwal,
            tglAkhir: tglAkhir,
            opsi: 'brg_in'
        };

        $.ajax({
            url: "<?= base_url('admin/historystock/his_brg') ?>",
            type: "POST",
            data: data,
            dataType: "json",
            beforeSend: function() {
                $("#div-history-stock-in").html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');
            },
            success: function(response) {
                $("#div-history-stock-in").html(response.data);
                // Reinitialize pagination if needed
                if (typeof initPagination === 'function') {
                    initPagination();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat memuat data',
                    timer: 2000,
                    timerProgressBar: true
                });
            }
        });
    });
});
</script>
<?php $this->endSection() ?>