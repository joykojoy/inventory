<!-- Menampilan alert hasil verifikasi -->
<?php session();
if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-<?= $_SESSION['color'] ?> alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i> <?= session()->getFlashdata('pesan'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>