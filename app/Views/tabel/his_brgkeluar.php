<div class="row mt-4">
    <div class="col text-start">
        <h5 class="card-title">History Pengeluaran Barang</h5>
        <?php if(!empty($tglAwal) && !empty($tglAkhir)): ?>
            <p class="text-muted">Periode: <?= date('d-m-Y', strtotime($tglAwal)) ?> s/d <?= date('d-m-Y', strtotime($tglAkhir)) ?></p>
        <?php endif; ?>
    </div>
    <div class="col text-end">
        <?php if(!empty($tglAwal) && !empty($tglAkhir)): ?>
            <a href="/admin/historystock/his_brg_pdf/<?= $tglAwal ?>/<?= $tglAkhir ?>/brg_out" target="_blank" class="btn btn-sm btn-danger">
                <i class="bi bi-printer me-2"></i>Print
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="table-responsive">
    <?php if(!empty($data)): ?>
        <table class="table table-hover table-striped mt-3" id="tblHistoryKeluar">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Group</th>
                    <th class="text-end">Jumlah Keluar</th>
                    <th>Satuan</th>
                    <th class="text-end">Harga</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($data as $d): 
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d-m-Y', strtotime($d->tgl)) ?></td>
                        <td><?= $d->kode_brg ?></td>
                        <td><?= $d->nama_brg ?></td>
                        <td><?= $d->nama_group ?></td>
                        <td class="text-end"><?= number_format($d->qtt_out, 0, ',', '.') ?></td>
                        <td><?= $d->nama_satuan ?></td>
                        <td class="text-end"><?= number_format($d->harga, 0, ',', '.') ?></td>
                        <td class="text-end"><?= number_format($d->qtt_out * $d->harga, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
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