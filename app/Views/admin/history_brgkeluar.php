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
                        <input type="date" class="form-control" id="tglawal-his-out">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="tgl_faktur" class="form-label">Tanggal akhir</label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" id="tglakhir-his-out">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tampilkan history </label>
                    <div class="input-group mb-3">
                        <button type="button" class="btn btn-success me-2" id="cari-his-brgkeluar">
                            Cari &nbsp;<i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="div-history-stock-out"></div>
            
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchBtn = document.getElementById('cari-his-brgkeluar');
    const excelLink = document.getElementById('excel-export-link');
    
    searchBtn.addEventListener('click', function() {
        const tglAwal = document.getElementById('tglawal-his-out').value;
        const tglAkhir = document.getElementById('tglakhir-his-out').value;
        
        if (!tglAwal || !tglAkhir) {
            alert('Silakan pilih tanggal terlebih dahulu!');
            return;
        }

        // Update Excel export link
        excelLink.href = `<?= base_url('admin/barangkeluar/excel') ?>/${tglAwal}/${tglAkhir}/brg_out`;
        excelLink.style.display = 'inline-block';

        // Your existing AJAX call for searching
        $.ajax({
            url: "/admin/historystock/his_brg",
            type: "POST",
            data: {
                tglAwal: tglAwal,
                tglAkhir: tglAkhir,
                opsi: 'brg_out'
            },
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    $("#div-history-stock-out").html(response.data);
                }
            }
        });
    });
});
</script>

<?php $this->endSection() ?>