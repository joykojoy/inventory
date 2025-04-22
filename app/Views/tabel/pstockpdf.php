<table class="table table-hover table-bordered">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Group</th>
            <th>Satuan</th>
            <th class="text-end">HPP</th>
            <th class="text-end">Stock</th>
            <th class="text-end">Value Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        $totalValue = 0;
        foreach ($data as $r): 
            $valueStock = $r->harga * $r->qtt;
            $totalValue += $valueStock;
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $r->kode_brg ?></td>
            <td><?= $r->nama_brg ?></td>
            <td><?= $r->nama_group ?></td>
            <td><?= $r->nama_satuan ?></td>
            <td class="text-end"><?= number_format($r->harga, 0, ',', '.') ?></td>
            <td class="text-end"><?= number_format($r->qtt, 0, ',', '.') ?></td>
            <td class="text-end"><?= number_format($valueStock, 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
        <tr class="fw-bold">
            <td colspan="7" class="text-end">Total Value Stock:</td>
            <td class="text-end"><?= number_format($totalValue, 0, ',', '.') ?></td>
        </tr>
    </tbody>
</table>