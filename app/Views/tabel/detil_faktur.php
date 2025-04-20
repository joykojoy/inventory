<table class="table table-light table-striped">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Barang</td>
            <td class="text-end">Quantity</td>
            <td class="text-end">HPP</td>
            <td class="text-end">Subtotal</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        $total = 0;
        foreach ($data as $d) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->kode_brg ?></td>
                <td class="text-end"><?= $d->qtt ?></td>
                <td class="text-end"><?= number_format($d->hpp, 0, ',', '.') ?></td>
                <td class="text-end"><?= number_format($d->subtotal, 0, ',', '.') ?></td>
            </tr>
            <?php $total += $d->subtotal ?>
        <?php endforeach ?>
        <tr class="fw-bold">
            <td class="text-center" colspan="4">Total</td>
            <td class="text-end"><?= number_format($total, 0, ',', '.') ?></td>
        </tr>
    </tbody>
</table>