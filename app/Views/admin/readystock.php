<?php
$this->session = \Config\Services::session();
$this->extend('shared_pages/templete');
$this->section('content');
?>
<section class="section">
    <?= $this->include('shared_pages/alert') ?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col text-start">
                    <h5 class="card-title">Stock Barang</h5>
                </div>
                <div class="col text-end">
                    <a href="/admin/historystock/listpdf" target="_blank" class="btn btn-sm btn-danger">
                        <i class="bi bi-printer me-2"></i>Print
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover mb-0" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Group</th>
                        <th>Qty</th>
                        <th>Min Stok</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (isset($dtstock) && (is_array($dtstock) || is_object($dtstock))) : 
                    $no = 1;
                    foreach ($dtstock as $item) : 
                        // Set status
                        if ($item->qtt == 0) {
                            $status_class = 'text-danger fw-bold';
                            $status_text = 'Kosong';
                        } elseif ($item->qtt <= $item->min_stok) {
                            $status_class = 'text-warning fw-bold';
                            $status_text = 'Warning';
                        } else {
                            $status_class = 'text-success';
                            $status_text = 'Normal';
                        }
                ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item->kode_brg) ?></td>
                            <td><?= esc($item->nama_brg) ?></td>
                            <td><?= esc($item->nama_satuan) ?></td>
                            <td><?= esc($item->nama_group) ?></td>
                            <td><?= esc($item->qtt) ?></td>
                            <td><?= esc($item->min_stok) ?></td>
                            <td>Rp <?= number_format($item->harga, 2, ',', '.') ?></td>
                            <td class="<?= $status_class ?>"><?= $status_text ?></td>
                        </tr>
                    <?php endforeach;
                else : ?>
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data stock</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table = document.querySelector('#table');
    let dataTable = new simpleDatatables.DataTable(table);
</script>
<?php $this->endSection() ?>