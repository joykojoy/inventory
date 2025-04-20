<table class="table table-light table-striped" id="table">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Satuan Barang</td>
            <td>Status</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($data as $d) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->nama ?></td>
                <td>
                    <span class="badge bg-<?= ($d->status == 1) ? 'success' : 'danger' ?>"><?= ($d->status == 1) ? 'Aktif' : 'Non aktif' ?></span>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-success btn-edit-satuan" data-id="<?= $d->id ?>" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-<?= ($d->status == 0) ? 'aktifkan' : 'nonaktifkan' ?>-satuan" data-id="<?= $d->id ?>" title="<?= ($d->status == 0) ? 'Akifkan' : 'Nonaktifkan' ?>">
                        <?= ($d->status == 0) ? '<i class="bi bi-box-arrow-in-left"></i>' : '<i class="bi bi-stop-circle"></i>' ?>
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-hapus-satuan" data-id="<?= $d->id ?>" title="Hapus">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>