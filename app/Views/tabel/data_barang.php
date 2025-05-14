<table class="table table-light table-striped" id="table">
    <thead>
        <tr>
            <td>No</td>
            <td>Group</td>
            <td>Kode</td>
            <td>Nama Barang</td>
            <td>Satuan</td>
            <td>Lokasi</td>
            <td>Min Stok</td>
            <td>Harga</td>
            <td>Status</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($data as $d) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->nama_group ?></td>
                <td><?= $d->kode ?></td>
                <td><?= $d->nama_barang ?></td>
                <td><?= $d->nama_satuan ?></td>
                <td><?= $d->kode_lokasi ?></td>
                <td><?= $d->min_stok ?></td>
                <td><?= number_format($d->harga, 2, ',', '.') ?></td>
                <td>
                    <span class="badge bg-<?= ($d->status == 1) ? 'success' : 'danger' ?>"><?= ($d->status == 1) ? 'Aktif' : 'Non aktif' ?></span>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-success btn-edit-barang" data-kode_barang="<?= $d->kode_barang ?>" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-<?= ($d->status == 0) ? 'aktifkan' : 'nonaktifkan' ?>-barang" data-barang="<?= $d->kode ?>" title="<?= ($d->status == 0) ? 'Akifkan' : 'Nonaktifkan' ?>">
                        <?= ($d->status == 0) ? '<i class="bi bi-box-arrow-in-left"></i>' : '<i class="bi bi-stop-circle"></i>' ?>
                    </button>
                    <button type="button" 
                            class="btn btn-outline-danger btn-hapus-barang" 
                            data-id="<?= $d->id ?>">
                        <i class="bi bi-trash"></i> 
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>