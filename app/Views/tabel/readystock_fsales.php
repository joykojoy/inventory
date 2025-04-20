<h5 class="card-title text-center mt-4">Ready Stock Barang</h5>
<table class="table table-light table-striped" id="table">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Group</td>
            <td>Nama Barang</td>
            <td>Quantity</td>
            <td>Satuan</td>
            <td>Harga</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($data as $d) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->nama_group ?></td>
                <td><?= $d->nama_brg ?></td>
                <td class="text-end"><?= number_format($d->qtt, 0, ',', '.') ?></td>
                <td class="text-center"><?= $d->nama_satuan ?></td>
                <td class="text-end"><?= number_format($d->harga, 2, ',', '.') ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>