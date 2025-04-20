<table class="table table-light table-striped" id="table">
    <thead>
        <tr>
            <td>No</td>
            <td>No Faktur</td>
            <td>Supplier</td>
            <td>Tanggal</td>
            <td>Total</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($data as $d) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->no_faktur ?></td>
                <td><?= $d->nama_supplier ?></td>
                <td><?= date($d->tgl_faktur) ?></td>
                <td>
                    <a href="#" class="text-dark detil-faktur" data-nofaktur="<?= $d->no_faktur ?>" title="click utk lihat perincian">
                        <?= number_format($d->total, 0, ',', '.') ?>
                    </a>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-success btn-edit-fbrgmasuk" data-nofaktur="<?= $d->no_faktur ?>" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-retur-faktur" data-nofaktur="<?= $d->no_faktur ?>" title="Hapus Faktur">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>