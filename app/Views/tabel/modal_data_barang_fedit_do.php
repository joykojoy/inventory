<table class="table table-light table-striped" id="table">
    <thead>
        <tr>
            <td>No</td>
            <td>Group</td>
            <td>Kode</td>
            <td>Nama Barang</td>
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
                <td>
                    <button type="button" class="btn btn-outline-success btn-pilih-barang-fedit-do" data-kode_barang-fedit-do="<?= $d->kode_barang ?>">
                        Pilih
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<script>
    // pilih item barang
    $(".btn-pilih-barang-fedit-do").click(function() {
        let kodeBarang = $(this).data('kode_barang-fedit-do')
        load_item_fedit_do(kodeBarang)
        $("#kode-brg-do-fedit").val(kodeBarang)
        $(".modal").modal("toggle")
    })
</script>