<table class="table table-light table-striped">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Barang</td>
            <td class="text-end">Quantity</td>
            <td class="text-end">Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        $total = 0;
        foreach ($data as $d) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->nama_brg ?></td>
                <td class="text-end"><?= $d->qtt ?></td>
                <td class="text-end">
                    <button type="button" class="btn btn-outline-danger btn-delete-brgtemp-keluar" title="Hapus" data-id="<?= $d->id ?>">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<script>
    $(".btn-delete-brgtemp-keluar").click(function() {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/barangkeluar/delete_detilbarang",
            data: {
                id: id
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    data_temp_keluar()
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: responds.psn,
                    })
                }
            }
        });
    })
</script>