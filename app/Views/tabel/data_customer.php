<table class="table table-light table-striped" id="table">
    <thead>
        <tr>
            <td>No</td>
            <td>Kode</td>
            <td>Nama Customer</td>
            <td>P.I.C</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($data as $d) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->kode ?></td>
                <td><?= $d->nama ?></td>
                <td><?= $d->pic ?></td>
                <td>
                    <button type="button" class="btn btn-outline-success btn-edit-customer" data-id="<?= $d->id ?>" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-hapus-customer" data-id="<?= $d->id ?>" title="Hapus">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>