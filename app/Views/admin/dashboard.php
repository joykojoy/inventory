<?php 
// Update the helper function at the top of your file
function isAllowed($requiredLevel) {
    $session = session();
    return $session->get('level') <= $requiredLevel; // Changed from >= to <=
}
?>

<?= $this->extend('shared_pages/templete') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <!-- stok ready box -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card <?= !isAllowed(2) ? 'opacity-50' : '' ?>">
                        <?php if (isAllowed(2)): ?>
                            <a href="<?= base_url('admin/master_barang') ?>" class="text-decoration-none">
                        <?php else: ?>
                            <div class="disabled-link" onclick="showAccessDenied()">
                        <?php endif; ?>
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Barang Ready</h6>
                                        <h6 class="font-extrabold mb-0">
                                            <?= isset($dtstock) ? count($dtstock) : '0' ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        <?php if (isAllowed(2)): ?>
                            </a>
                        <?php else: ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- stok ready box -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card <?= !isAllowed(2) ? 'opacity-50' : '' ?>">
                        <?php if (isAllowed(2)): ?>
                            <a href="<?= base_url('admin/master_barang') ?>" class="text-decoration-none">
                        <?php else: ?>
                            <div class="disabled-link" onclick="showAccessDenied()">
                        <?php endif; ?>
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Stok Barang Ready</h6>
                                        <h6 class="font-extrabold mb-0">
                                            <?= isset($dtstock) ? array_sum(array_column($dtstock, 'qtt')) : '0' ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        <?php if (isAllowed(2)): ?>
                            </a>
                        <?php else: ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Barang Masuk box -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card <?= !isAllowed(2) ? 'opacity-50' : '' ?>">
                        <?php if (isAllowed(2)): ?>
                            <a href="<?= base_url('admin/barangmasuk') ?>" class="text-decoration-none">
                        <?php else: ?>
                            <div class="disabled-link" onclick="showAccessDenied()">
                        <?php endif; ?>
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="bi bi-box-arrow-in-down"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Stok Barang Masuk</h6>
                                        <h6 class="font-extrabold mb-0"><?= isset($total_barang_masuk) ? esc($total_barang_masuk) : '0' ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php if (isAllowed(2)): ?>
                            </a>
                        <?php else: ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Barang Masuk box -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card <?= !isAllowed(2) ? 'opacity-50' : '' ?>">
                        <?php if (isAllowed(2)): ?>
                            <a href="<?= base_url('admin/barangmasuk') ?>" class="text-decoration-none">
                        <?php else: ?>
                            <div class="disabled-link" onclick="showAccessDenied()">
                        <?php endif; ?>
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="bi bi-box-arrow-in-down"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Jumlah Barang Masuk</h6>
                                        <h6 class="font-extrabold mb-0"><?= isset($transaksi_masuk) ? esc($transaksi_masuk) : '0' ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php if (isAllowed(2)): ?>
                            </a>
                        <?php else: ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Barang Keluar box -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card <?= !isAllowed(2) ? 'opacity-50' : '' ?>">
                        <?php if (isAllowed(2)): ?>
                            <a href="<?= base_url('admin/barangkeluar') ?>" class="text-decoration-none">
                        <?php else: ?>
                            <div class="disabled-link" onclick="showAccessDenied()">
                        <?php endif; ?>
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="bi bi-box-arrow-up"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Stok Barang Keluar</h6>
                                        <h6 class="font-extrabold mb-0"><?= isset($total_barang_keluar) ? esc($total_barang_keluar) : '0' ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php if (isAllowed(2)): ?>
                            </a>
                        <?php else: ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Barang Keluar box -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card <?= !isAllowed(2) ? 'opacity-50' : '' ?>">
                        <?php if (isAllowed(2)): ?>
                            <a href="<?= base_url('admin/barangkeluar') ?>" class="text-decoration-none">
                        <?php else: ?>
                            <div class="disabled-link" onclick="showAccessDenied()">
                        <?php endif; ?>
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="bi bi-box-arrow-up"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Jumlah Barang Keluar</h6>
                                        <h6 class="font-extrabold mb-0"><?= isset($transaksi_keluar) ? esc($transaksi_keluar) : '0' ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php if (isAllowed(2)): ?>
                            </a>
                        <?php else: ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- User box -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card <?= !isAllowed(2) ? 'opacity-50' : '' ?>">
                        <?php if (isAllowed(2)): ?>
                            <a href="<?= base_url('admin/manuser') ?>" class="text-decoration-none">
                        <?php else: ?>
                            <div class="disabled-link" onclick="showAccessDenied()">
                        <?php endif; ?>
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pengguna</h6>
                                        <h6 class="font-extrabold mb-0"><?= isset($total_user) ? esc($total_user) : '0' ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php if (isAllowed(2)): ?>
                            </a>
                        <?php else: ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Supplier Stats -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card <?= !isAllowed(2) ? 'opacity-50' : '' ?>">
                        <?php if (isAllowed(2)): ?>
                            <a href="<?= base_url('admin/mansupplier') ?>" class="text-decoration-none">
                        <?php else: ?>
                            <div class="disabled-link" onclick="showAccessDenied()">
                        <?php endif; ?>
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Supplier</h6>
                                        <h6 class="font-extrabold mb-0"><?= isset($total_supplier) ? esc($total_supplier) : '0' ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php if (isAllowed(2)): ?>
                            </a>
                        <?php else: ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Add after the supplier box, before the Charts Row -->
                <!-- Warning Stock Box -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card <?= !isAllowed(2) ? 'opacity-50' : '' ?>">
                        <?php if (isAllowed(2)): ?>
                            <a href="<?= base_url('admin/master_barang') ?>" class="text-decoration-none">
                        <?php else: ?>
                            <div class="disabled-link" onclick="showAccessDenied()">
                        <?php endif; ?>
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon warning">
                                            <i class="bi bi-exclamation-triangle"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Stok Warning</h6>
                                        <h6 class="font-extrabold mb-0">
                                            <?php
                                            $warningCount = 0;
                                            foreach ($dtstock as $item) {
                                                if (is_object($item)) {
                                                    // If item is an object
                                                    if ($item->qtt <= $item->min_stok && $item->qtt > 0) {
                                                        $warningCount++;
                                                    }
                                                } else {
                                                    // If item is an array
                                                    if ($item['qtt'] <= $item['min_stok'] && $item['qtt'] > 0) {
                                                        $warningCount++;
                                                    }
                                                }
                                            }
                                            echo $warningCount;
                                            ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        <?php if (isAllowed(2)): ?>
                            </a>
                        <?php else: ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Empty Stock Box -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card <?= !isAllowed(2) ? 'opacity-50' : '' ?>">
                        <?php if (isAllowed(2)): ?>
                            <a href="<?= base_url('admin/master_barang') ?>" class="text-decoration-none">
                        <?php else: ?>
                            <div class="disabled-link" onclick="showAccessDenied()">
                        <?php endif; ?>
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon danger">
                                            <i class="bi bi-x-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Stok Kosong</h6>
                                        <h6 class="font-extrabold mb-0">
                                            <?php
                                            $emptyCount = 0;
                                            foreach ($dtstock as $item) {
                                                if (is_object($item)) {
                                                    // If item is an object
                                                    if ($item->qtt == 0) {
                                                        $emptyCount++;
                                                    }
                                                } else {
                                                    // If item is an array
                                                    if ($item['qtt'] == 0) {
                                                        $emptyCount++;
                                                    }
                                                }
                                            }
                                            echo $emptyCount;
                                            ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        <?php if (isAllowed(2)): ?>
                            </a>
                        <?php else: ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Top 5 Barang Masuk</h5>
                        </div>
                        <div class="card-body">
                            <div id="pieChartIncoming" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Top 5 Barang Keluar</h5>
                        </div>
                        <div class="card-body">
                            <div id="pieChartOutgoing" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ready Stock Table Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Warning Stock Barang</h5>
                                </div>
                                <div class="col text-end">
                                    <a href="<?= base_url('admin/historystock/listpdf') ?>" 
                                       target="_blank" 
                                       class="btn btn-sm btn-danger">
                                        <i class="bi bi-printer me-2"></i>Print
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?= $this->include('tabel/dashboard') ?>
                                
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
                                                        <i class="bi bi-chevron-left"></i>
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
                </div>
            </div>

        </div>
    </section>
</div>

<!-- Add DataTable Scripts at the bottom -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let table = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table, {
            searchable: true,
            fixedHeight: true,
            perPage: 5,
            labels: {
                placeholder: "Cari...",
                perPage: "{select} data per halaman",
                noResults: "Tidak ada data ditemukan",
                info: "Menampilkan {start} sampai {end} dari {rows} data"
            }
        });
    });

    function showAccessDenied() {
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Anda tidak memiliki akses ke fitur ini',
            confirmButtonColor: '#3085d6',
        });
    }

    // Update the level check
    document.addEventListener('DOMContentLoaded', function() {
        const level = <?= session()->get('level') ?>;
        if (level > 2) {
            const links = document.querySelectorAll('.card-link');
            links.forEach(link => {
                link.style.cursor = 'pointer';
            });
        }
    });
</script>

<!-- Load Google Charts -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawCharts);

                function drawCharts() {
                    // Incoming Items Chart
                    var incomingData = google.visualization.arrayToDataTable([
                        ['Barang', 'Jumlah'],
                        <?php foreach ($topIncoming as $item): ?>
                        ['<?= $item['nama_brg'] ?>', <?= $item['total'] ?>],
                        <?php endforeach; ?>
                    ]);

                    var incomingOptions = {
                        title: 'Top 5 Barang Masuk',
                        pieHole: 0.4,
                        colors: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                        chartArea: {width: '100%', height: '80%'},
                        legend: {position: 'bottom'}
                    };

                    var incomingChart = new google.visualization.PieChart(document.getElementById('pieChartIncoming'));
                    incomingChart.draw(incomingData, incomingOptions);

                    // Outgoing Items Chart
                    var outgoingData = google.visualization.arrayToDataTable([
                        ['Barang', 'Jumlah'],
                        <?php foreach ($topOutgoing as $item): ?>
                        ['<?= $item['nama_brg'] ?>', <?= $item['total'] ?>],
                        <?php endforeach; ?>
                    ]);

                    var outgoingOptions = {
                        title: 'Top 5 Barang Keluar',
                        pieHole: 0.4,
                        colors: ['#e74a3b', '#f6c23e', '#36b9cc', '#1cc88a', '#4e73df'],
                        chartArea: {width: '100%', height: '80%'},
                        legend: {position: 'bottom'}
                    };

                    var outgoingChart = new google.visualization.PieChart(document.getElementById('pieChartOutgoing'));
                    outgoingChart.draw(outgoingData, outgoingOptions);
                }

                // Redraw charts on window resize
                window.addEventListener('resize', drawCharts);
            </script>
        </div>
    </section>
</div>

<!-- Add this CSS -->
<style>
.disabled-link {
    cursor: not-allowed;
}
.opacity-50 {
    opacity: 0.5;
}
.card-link {
    cursor: pointer;
}
.card-link:hover {
    background-color: rgba(0, 0, 0, 0.02);
}
.stats-icon.warning {
    background: #ffc107;
    color: #fff;
}

.stats-icon.danger {
    background: #dc3545;
    color: #fff;
}

.stats-icon {
    width: 3rem;
    height: 3rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<?= $this->endSection() ?>
