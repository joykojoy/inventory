<table class="table table-light table-striped" id="table">
    <thead>
        <tr>
            <td>No</td>
            <td>Kode</td>
            <td>Nama Supplier</td>
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
                    <button type="button" class="btn btn-outline-success btn-edit-supplier" title="Edit" data-id="<?= $d->id ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-hapus-supplier" title="Hapus" data-id="<?= $d->id ?>">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>