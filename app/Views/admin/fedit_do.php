<?php
$this->session = \Config\Services::session();
$this->extend('shared_pages/templete');
$this->section('content');
?>
<section class="section">
    <?= $this->include('shared_pages/alert') ?>
    <div class="card">
        <div class="card-body">
            <button class="btn btn-sm bg-indigo text-light btn-backto-brgkeluar mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward" viewBox="0 0 16 16">
                    <path d="M.5 3.5A.5.5 0 0 1 1 4v3.248l6.267-3.636c.52-.302 1.233.043 1.233.696v2.94l6.267-3.636c.52-.302 1.233.043 1.233.696v7.384c0 .653-.713.998-1.233.696L8.5 8.752v2.94c0 .653-.713.998-1.233.696L1 8.752V12a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm7 1.133L1.696 8 7.5 11.367V4.633zm7.5 0L9.196 8 15 11.367V4.633z" />
                </svg>&nbsp
                Back
            </button>
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="nomer_do" class="form-label">Nomer DO</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="<?= $data[0]->no_do ?>" id="no-do-fedit" readonly>
                        <button class="btn btn-outline-success" type="button" id="button-addon2"><i class="bi bi-app"></i></button>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="tgl_do" class="form-label">Tanggal keluar barang</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="<?= $data[0]->tgl_do ?>" id="tgl-do-fedit" readonly>
                        <button class="btn btn-outline-success" type="button" id="button-addon2"><i class="bi bi-app"></i></button>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="nomer_do" class="form-label">Nama Customer</label>
                    <div class="input-group mb-3">
                        <input type="hidden" id="customer-do-fedit" class="form-control" value="<?= $data[0]->customer ?>">
                        <input type="text" class="form-control" value="<?= $data[0]->nama_customer ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="card">
                <h6 class="card-header bg-indigo bg-gradient text-light py-2"> Form Edit DO Pengeluaran Barang </h6>
                <div class="card-body mt-3">
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label class="form-label">Kode Barang</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="kode-brg-do-fedit">
                                <button class="btn btn-success btn-cari-fedit-do" type="button"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama-brg-do-fedit" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlah-brg-do-fedit">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Harga Satuan</label>
                            <input type="number" class="form-control" id="hrg-do-fedit">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Aksi</label>
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-outline-success" id="add-do-fedit" title="Simpan">
                                    <i class="bi bi-plus-circle-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <h6 class="card-header mt-3 text-center"> Detil Perincian DO </h6>
                    <div class="div-cari-item-fedit-do"></div>
                    <div class="div-do-fedit"></div>
                    <div class="row text-end">
                        <div class="col">
                            <button type="button" class="btn bg-indigo text-light btn-update-do">
                                <i class="bi bi-file-earmark-text-fill"></i>&nbsp&nbspUpdate
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection() ?>