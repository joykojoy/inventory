<?php
$this->session = \Config\Services::session();
$this->extend('shared_pages/templete');
$this->section('content');
?>
<section class="section">
    <?= $this->include('shared_pages/alert') ?>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Master Barang</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <button class="btn bg-indigo text-light btn-add-barang">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
                        </svg>
                        Tambah Barang
                    </button>
                </div>
                <div class="col-6">
                    <form action="" method="get" id="searchForm" class="d-flex justify-content-end">
                        <div style="width: 33%;">
                            <input type="text" name="search" id="searchInput" class="form-control" 
                                placeholder="Cari barang..." value="<?= isset($keyword) ? $keyword : '' ?>"
                                oninput="handleSearch(this.value)">
                        </div>
                        <?php if(isset($keyword) && !empty($keyword)): ?>
                            <a href="<?= site_url('admin/master_barang') ?>" class="btn btn-secondary ms-2">Reset</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            
            <div class="div-barang"></div>
            <div class="table-responsive">
                <?= $this->include('tabel/data_barang') ?>
                
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
                                    <a class="page-link" href="?page=<?= $currentPage - 1 ?><?= isset($keyword) ? '&search='.$keyword : '' ?>">
                                        <i class="bi bi-chevron-left"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                            <?php for($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?><?= isset($keyword) ? '&search='.$keyword : '' ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $currentPage + 1 ?><?= isset($keyword) ? '&search='.$keyword : '' ?>">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/assets/js/master_barang.js"></script>
<script>
    // Auto-search functionality
    let searchTimeout;
    
    function handleSearch(value) {
        // Clear any existing timeout
        clearTimeout(searchTimeout);
        
        // Set a new timeout (300ms delay for typing)
        searchTimeout = setTimeout(() => {
            // Submit the form when user stops typing
            document.getElementById('searchForm').submit();
        }, 500);
    }
</script>

<?php $this->endSection() ?>