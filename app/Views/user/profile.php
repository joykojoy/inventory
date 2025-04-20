<?php
$this->session = \Config\Services::session();
$this->extend('shared_pages/templete');
$this->section('content');
?>
<section class="section">
    <?= $this->include('shared_pages/alert') ?>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="/assets/images/faces/5.jpg" width="250px" class="img-fluid rounded-start" alt="photo profile">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">Profile</h3>
                    <p>Nama Pegawai : <?= $this->session->nama ?></p>
                    <p>Level : <?= $this->session->nama_level ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection() ?>