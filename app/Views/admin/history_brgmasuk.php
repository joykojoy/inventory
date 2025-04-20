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
            <div class="table-responsive">
                <!-- ...existing table code... -->

                <!-- Add pagination -->
                <?php if(isset($totalPages) && $totalPages > 1): ?>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan <?= ($currentPage - 1) * $perPage + 1 ?> sampai 
                        <?= min($currentPage * $perPage, $total) ?> dari <?= $total ?> data
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            <?php if($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $currentPage - 1 ?>">
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
<?php $this->endSection() ?>  <i class="bi bi-chevron-left"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                            <?php for($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $currentPage + 1 ?>">
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection() ?>