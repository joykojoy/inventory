<div class="table-responsive">
    <table class="table table-light table-striped">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama Barang</td>
                <td class="text-end">Quantity</td>
                <td class="text-end">HPP</td>
                <td class="text-end">Subtotal</td>
                <td class="text-end">Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            $total = 0;
            foreach ($data as $d) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d->nama_brg ?></td>
                    <td class="text-end"><?= $d->qtt ?></td>
                    <td class="text-end"><?= number_format($d->hpp, 0, ',', '.') ?></td>
                    <td class="text-end"><?= number_format($d->subtotal, 0, ',', '.') ?></td>
                    <td class="text-end">
                        <button type="button" class="btn btn-outline-danger btn-delete-input-brgtemp" title="Hapus" data-id="<?= $d->id ?>">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
                <?php $total += $d->subtotal ?>
            <?php endforeach ?>
            <tr class="fw-bold">
                <td class="text-center" colspan="4">Total</td>
                <td class="text-end"><?= number_format($total, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

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
                        <a class="page-link" href="javascript:void(0)" onclick="loadPage(<?= $currentPage - 1 ?>)">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php for($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                        <a class="page-link" href="javascript:void(0)" onclick="loadPage(<?= $i ?>)"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" onclick="loadPage(<?= $currentPage + 1 ?>)">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <?php endif; ?>

    <script>
        $(".btn-delete-input-brgtemp").click(function() {
            let id = $(this).data('id')
            $.ajax({
                url: "/admin/barangmasuk/delete_detilbarang",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(responds) {
                    if (responds.status) {
                        data_temp()
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: responds.psn,
                        })
                    }
                }
            });
        })
    </script>