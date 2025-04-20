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
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php if (isset($dtstock) && (is_array($dtstock) || is_object($dtstock))) : 
        $no = 1;
        foreach ($dtstock as $item) : 
            // Calculate status
            if ($item->qtt == 0) {
                $status_class = 'text-danger fw-bold';
                $status_text = 'Kosong';
                // Show row for Empty status
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($item->kode_brg) ?></td>
                    <td><?= esc($item->nama_brg) ?></td>
                    <td><?= esc($item->nama_satuan) ?></td>
                    <td><?= esc($item->nama_group) ?></td>
                    <td><?= esc($item->qtt) ?></td>
                    <td><?= esc($item->min_stok) ?></td>
                    <td class="<?= $status_class ?>"><?= $status_text ?></td>
                </tr>
                <?php
            } elseif ($item->qtt <= $item->min_stok) {
                $status_class = 'text-warning fw-bold';
                $status_text = 'Warning';
                // Show row for Warning status
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($item->kode_brg) ?></td>
                    <td><?= esc($item->nama_brg) ?></td>
                    <td><?= esc($item->nama_satuan) ?></td>
                    <td><?= esc($item->nama_group) ?></td>
                    <td><?= esc($item->qtt) ?></td>
                    <td><?= esc($item->min_stok) ?></td>
                    <td class="<?= $status_class ?>"><?= $status_text ?></td>
                </tr>
                <?php
            }
            // Skip items with Normal status by not rendering them
        endforeach;
    else : ?>
        <tr>
            <td colspan="8" class="text-center">Tidak ada data stock yang perlu perhatian</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>