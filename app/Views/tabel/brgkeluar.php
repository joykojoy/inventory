<table class="table table-light table-striped" id="table">
    <thead>
        <tr>
            <td>No</td>
            <td># DO</td>
            <td>Customer</td>
            <td>Tanggal</td>
            <td>Nama Barang</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($data as $d) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->no_do ?></td>
                <td><?= $d->customer ?></td>
                <td><?= date($d->tgl_do) ?></td>
                <td><?= $d->nama_brg ?></td>
                <td>
                    <button type="button" class="btn btn-outline-success btn-edit-brgkeluar" data-no_do="<?= $d->no_do ?>" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-retur-do" data-no_do="<?= $d->no_do ?>" title="Retur DO">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>