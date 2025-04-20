<table class="table table-light">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Group</td>
            <td>Nama Barang</td>
            <td>Quantity</td>
            <td>Satuan</td>
            <td>HPP</td>
            <td>Value Stock</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($data as $d) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->nama_group ?></td>
                <td><?= $d->nama_brg ?></td>
                <td class="text-end"><?= $d->qtt ?></td>
                <td class="text-center"><?= $d->nama_satuan ?></td>
                <td class="text-end"><?= number_format($d->hpp, 0, ',', '.') ?></td>
                <?php $value = $d->hpp * $d->qtt ?>
                <td class="text-end"><?= number_format($value, 0, ',', '.') ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>