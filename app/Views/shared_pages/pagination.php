<?php if (isset($pager)): ?>
<div class="pagination-container">
    <div class="pagination-info">
        <?php 
        $startNum = (($currentPage - 1) * $perPage) + 1;
        $endNum = min($currentPage * $perPage, $total);
        ?>
        Menampilkan <?= number_format($startNum, 0, ',', '.') ?> sampai 
        <?= number_format($endNum, 0, ',', '.') ?> dari <?= number_format($total, 0, ',', '.') ?> data
    </div>
    <?php if ($totalPages > 1): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($currentPage > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $currentPage - 1 ?><?= isset($search) ? '&search='.$search : '' ?><?= isset($tglAwal) ? '&tglAwal='.$tglAwal.'&tglAkhir='.$tglAkhir : '' ?>">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?><?= isset($search) ? '&search='.$search : '' ?><?= isset($tglAwal) ? '&tglAwal='.$tglAwal.'&tglAkhir='.$tglAkhir : '' ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
            
            <?php if ($currentPage < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $currentPage + 1 ?><?= isset($search) ? '&search='.$search : '' ?><?= isset($tglAwal) ? '&tglAwal='.$tglAwal.'&tglAkhir='.$tglAkhir : '' ?>">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>
<?php endif; ?>