<div class="row mt-4">
    <div class="col text-start">
        <h5 class="card-title">History Penerimaan Barang</h5>
        <?php if(!empty($tglAwal) && !empty($tglAkhir)): ?>
            <p class="text-muted">Periode: <?= date('d-m-Y', strtotime($tglAwal)) ?> s/d <?= date('d-m-Y', strtotime($tglAkhir)) ?></p>
        <?php endif; ?>
    </div>
    <div class="col text-end">
        <?php if(!empty($tglAwal) && !empty($tglAkhir)): ?>
            <a href="/admin/historystock/his_brg_pdf/<?= $tglAwal ?>/<?= $tglAkhir ?>/brg_in" target="_blank" class="btn btn-sm btn-danger">
                <i class="bi bi-printer me-2"></i>Print
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="table-responsive">
    <?php if(!empty($data)): ?>
        <table class="table table-hover table-striped mt-3" id="tblHistoryMasuk">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Group</th>
                    <th class="text-end">Total Masuk</th>
                    <th>Satuan</th>
                    <th class="text-end">Harga</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                $totalQty = 0;
                $totalNilai = 0;
                foreach ($data as $d): 
                    $totalQty += $d->qtt_in;
                    $totalNilai += $d->total_price_in;
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d-m-Y', strtotime($d->tgl)) ?></td>
                        <td><?= $d->kode_brg ?></td>
                        <td><?= $d->nama_brg ?></td>
                        <td><?= $d->nama_group ?></td>
                        <td class="text-end"><?= number_format($d->qtt_in, 0, ',', '.') ?></td>
                        <td><?= $d->nama_satuan ?></td>
                        <td class="text-end"><?= number_format($d->harga, 0, ',', '.') ?></td>
                        <td class="text-end"><?= number_format($d->total_price_in, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <th colspan="5" class="text-end">Total:</th>
                    <th class="text-end"><?= number_format($totalQty, 0, ',', '.') ?></th>
                    <th></th>
                    <th colspan="2" class="text-end"><?= number_format($totalNilai, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    <?php else: ?>
        <div class="alert alert-info mt-3">
            Tidak ada data untuk ditampilkan.
            <?php if(empty($tglAwal) || empty($tglAkhir)): ?>
                Silahkan pilih rentang tanggal terlebih dahulu.
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>