<div id="debug-info" style="display:none">
<?php
if (!empty($data)) {
    $firstItem = $data[0];
    echo "First item: " . $firstItem->nama_brg . "<br>";
    echo "Price (raw): " . var_export($firstItem->harga, true) . "<br>";
    echo "Price type: " . gettype($firstItem->harga) . "<br>";
}
?>
</div>
<div class="row mt-4">
    <div class="col text-start">
        <h5 class="card-title">Stock Barang</h5>
        <?php if(!empty($tglAwal) && !empty($tglAkhir)): ?>
            <p class="text-muted">Periode: <?= date('d-m-Y', strtotime($tglAwal)) ?> s/d <?= date('d-m-Y', strtotime($tglAkhir)) ?></p>
        <?php endif; ?>
    </div>
    <div class="col text-end">
        <?php if(!empty($tglAwal) && !empty($tglAkhir)): ?>
            <a href="<?= base_url('admin/historystock/his_brg_pdf/' . $tglAwal . '/' . $tglAkhir) ?>" target="_blank" class="btn btn-sm btn-danger">
                <i class="bi bi-printer me-2"></i>Print
            </a>
            <a href="<?= base_url('admin/historystock/excel/' . $tglAwal . '/' . $tglAkhir) ?>" class="btn btn-success">
                <i class="bi bi-file-excel me-2"></i>Excel
            </a>
        <?php endif; ?>
    </div>
</div>
<div id="history-brg">
    <div class="table-responsive">
        <?php if(!empty($data)): ?>
            <table class="table table-hover table-striped mt-3" id="tblHistory">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Tanggal</td>
                        <td>Nama Barang</td>
                        <td class="text-end">Quantity In</td>
                        <td class="text-end">Quantity Out</td>
                        <td class="text-end">Harga Satuan</td>
                        <td class="text-end">Total In</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $grand_total_in = 0;
                    foreach ($data as $d) : 
                        // Calculate total in only
                        $total_in = $d->qtt_in * $d->harga;
                        $grand_total_in += $total_in;
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d-m-Y', strtotime($d->tgl)) ?></td>
                            <td><?= $d->nama_brg ?></td>
                            <td class="text-end"><?= number_format($d->qtt_in, 0, ',', '.') ?></td>
                            <td class="text-end"><?= number_format($d->qtt_out, 0, ',', '.') ?></td>
                            <td class="text-end">Rp <?= number_format($d->harga, 2, ',', '.') ?></td>
                            <td class="text-end">Rp <?= number_format($total_in, 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach ?>
                    <tr class="fw-bold">
                        <td colspan="6" class="text-end">Total Nilai Barang Masuk:</td>
                        <td class="text-end">Rp <?= number_format($grand_total_in, 2, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
            
            <!-- Add pagination -->
            <?= $this->include('shared_pages/pagination') ?>
        <?php else: ?>
            <!-- ...existing empty state code... -->
        <?php endif; ?>
    </div>
</div>