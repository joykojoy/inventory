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
                        <input type="date" class="form-control" id="tglawal-his">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="tgl_faktur" class="form-label">Tanggal akhir</label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" id="tglakhir-his">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tampilkan history </label>
                    <div class="input-group mb-3">
                        <button type="button" class="btn btn-success" id="cari-his-brg">Cari &nbsp&nbsp<i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
            <div id="div-history-stock1"></div>
        </div>
    </div>
</section>
<?php $this->endSection() ?>